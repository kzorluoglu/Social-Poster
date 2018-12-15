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

    /** @var IndexController */
    private $pageController;

    /**
     * @var \PDO
     */
    protected $db;

    /**
     * Run Index Controller
     */
    public function run()
    {
        $db = parent::getInstance();
        $this->db = $db->getConnection();

        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($page == '' || $page == 'home') {
            $this->pageController = new IndexController();
            $this->pageController->index();
        }

        if ($page == 'queue') {
            $this->pageController = new QueueController();
            $this->pageController->index();
        }

        if ($page == 'run') {
            $this->pageController = new QueueController();
            $this->pageController->run();
        }

        if ($page == 'admin') {
            $this->pageController = new AdminController();
            $this->pageController->index();
        }
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
     * @param $data
     */
    protected function prettyDebug($data)
    {
        echo '<pre>' . var_export($data, true) . '</pre>';
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
