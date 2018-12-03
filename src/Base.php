<?php
namespace d8devs\socialposter;

/**
 * Description of Base
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Base
{
    public function __construct()
    {
        $page = "";

        if (isset($_GET['page'])) {
            $page = $this->filterGET();
        }

        $this->get($page);
    }

    public function get($page)
    {
        if ($page == "twitter") {
            new Controller\TwitterController();
        }
        if ($page == "facebook") {
            new Controller\FacebookController();
        }
        if ($page == '') {
            new Controller\IndexController();
        }
    }

    private function filterGET()
    {
        return filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    }

    public function render($template, array $data = [])
    {
        if ($data) {
            extract($data);
        }
        ob_start();
        require __DIR__ . '/Templates/' . $template . '.php';
        $file = ob_get_clean();
        echo $file;
    }
}
