<?php
namespace d8devs\socialposter;

/**
 * Description of Base
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Base
{

    /** @var type string   */
    private $route;

    /** @var type FacebookController|IndexController|TwitterController|   */
    private $pageController;

    /** @var renderFile Html * */
    private $renderFile;

    public function __construct()
    {
        if (isset($_GET['page'])) {
            $route = $this->filterString($_GET['page']);
        }
        if (empty($_GET['page'])) {
            $route = '';
        }

        $this->setRoute($route);
        $this->get();
    }

    public function get()
    {
        if ($this->route == "twitter") {
            $this->pageController = new Controller\TwitterController();
        }
        if ($this->route == "facebook") {
            $this->pageController = new Controller\FacebookController();
        }
        if ($this->route == '') {
            $this->pageController = new Controller\IndexController();
        }
        return $this->pageController;
    }

    public function filterString($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function __toString()
    {
        return $this->pageController;
    }

    public function render($template, array $data = [])
    {
        if ($data) {
            extract($data);
        }
        ob_start();
        require __DIR__ . '/Templates/' . $template . '.php';
        $this->renderFile = ob_get_clean();
    }

    /**
     * Run
     * @return mixed
     */
    public function run()
    {
        echo $this->renderFile;
    }
}
