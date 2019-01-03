<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 20.12.18
 * Time: 13:38
 */

namespace D8devs\SocialPoster;

class Config
{
    /** @var array */
    protected $values;

    public function __construct()
    {
        $this->values['env'] = "development";
    }


    public function __get($name)
    {
        if (array_key_exists($name, $this->values)) {
            return $this->values[$name];
        }
    }
}
