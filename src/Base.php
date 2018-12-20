<?php

namespace d8devs\socialposter;

use d8devs\socialposter\Controller\AdminController;
use d8devs\socialposter\Controller\IndexController;
use d8devs\socialposter\Interfaces\Controller;
use d8devs\socialposter\Controller\QueueController;

/**
 * Description of Base
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Base extends Database
{

    /**
     * @var string
     */
    public $env;
    /**
     * @var \PDO
     */
    protected $db;
    /** @var IndexController */
    private $pageController;
    /**
     * @var string
     */
    private $page;

    /**
     * Run Index Controller
     */
    public function run()
    {
        $db = parent::getInstance();
        $this->db = $db->getConnection();

        $this->setPage(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS));

        if ($this->getPage() == '' || $this->getPage() == 'home') {
            $this->pageController = new IndexController();
            $this->pageController->index();
        }

        if ($this->getPage() == 'queue') {
            $this->pageController = new QueueController();
            $this->pageController->index();
        }

        if ($this->getPage() == 'run') {
            $this->pageController = new QueueController();
            $this->pageController->run();
        }

        if ($this->getPage() == 'admin') {
            $this->pageController = new AdminController();
            $this->pageController->index();
        }
    }

    /**
     * @return string|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string|null $page
     */
    public function setPage($page): void
    {
        $this->page = $page;
    }

    /**
     * @param $template
     * @param array $data
     * @return bool
     */
    public function render($template, $data = array())
    {
        $path = __DIR__ . '/Templates/' . $template . '.php';


        if (file_exists($path)) {
            extract($data);

            //Starts output buffering
            ob_start();

            include $path;
            $buffer = ob_get_contents();
            @ob_end_clean();

            echo $buffer;
        }
    }

    /**
     * Return Class Name
     *
     * @return string
     */
    public function getPageController()
    {
        return get_class($this->pageController);
    }
}
