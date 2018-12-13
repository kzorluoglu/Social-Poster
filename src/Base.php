<?php
namespace d8devs\socialposter;

use d8devs\socialposter\Controller\FacebookController;
use d8devs\socialposter\Controller\IndexController;
use d8devs\socialposter\Controller\TwitterController;
use d8devs\socialposter\Interfaces\Controller;
use d8devs\socialposter\Database;

/**
 * Description of Base
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Base implements Controller
{

    /** @var string   */
    private $route;

    /** @var FacebookController|IndexController|TwitterController   */
    private $pageController;

    /** @var mixed * */
    private $renderFile;

    public function __construct()
    {
        if (isset($_GET['page'])) {
            $this->setRoute($this->filterString($_GET['page']));
        }
        if (empty($_GET['page'])) {
            $this->setRoute('');
        }

        $this->get();
    }

    private function get()
    {
        $class = $this->getRoute();
        $controller = "d8devs\socialposter\Controller\\{$class}Controller";
        if (! class_exists($controller)) {
            $this->pageController = new Exceptions\NotFound();
        }
        if (class_exists($controller)) {
            $this->pageController = new $controller();
        }

        $this->pageController->index();
    }

    public function filterString($string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    private function setRoute($route)
    {
        if ($route == '') {
            $route = 'index';
        }
        $this->route = ucfirst($route);
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
        $path = require __DIR__ . '/Templates/' . $template . '.php';

        if (file_exists($path)) {
            if ($data) {
                extract($data);
            }

            ob_start();

            include $path;
            $this->renderFile = ob_get_contents();
            ob_end_clean();
        }
    }

    protected function prettyDebug($data)
    {
        echo '<pre>' . var_export($data, true) . '</pre>';
    }
}
