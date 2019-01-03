<?php

namespace D8devs\SocialPoster;

use mysql_xdevapi\Exception;

/**
 * Description of Base
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Base
{

    /**
     * Base Controller
     * @var
     */
    private $base;

    /**
     * @var mixed
     */
    private $registry;

    public function __construct()
    {
        $this->registry = [
            'Config' => 'D8devs\SocialPoster\Config',
            'Request' => 'D8devs\SocialPoster\Request',
            'Response' => 'D8devs\SocialPoster\Response',
            'Database' => 'D8devs\SocialPoster\Database',
        ];
    }

    public function __get($class)
    {

        if (array_key_exists($class, $this->registry)) {
            return new $this->registry[$class]();
        }

        if (array_key_exists($class, $this->registry) === false) {
            return new \Exception('This Class not registered');
        }
    }

}
