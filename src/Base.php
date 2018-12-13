<?php
namespace d8devs\socialposter;

use d8devs\socialposter\Controller\IndexController;
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


    /** @var mixed * */
    private $renderFile;


    public function run()
    {
        $this->pageController = new IndexController();
        $this->pageController->index();
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
