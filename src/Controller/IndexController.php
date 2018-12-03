<?php
namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;

/**
 * Description of IndexController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class IndexController extends Base
{
    public function __construct()
    {
        $this->index();
    }

    public function index()
    {
        $this->render('index');
    }
}
