<?php
namespace d8devs\socialposter\Exceptions;

use d8devs\socialposter\Base;

/**
 * Description of NotFound
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class NotFound extends Base
{

    public function __construct()
    {
        $this->render('Exceptions/NotFound');
    }
}
