<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 21.12.18
 * Time: 00:30
 */

namespace D8devs\SocialPoster;


class Response extends Base
{
    public function render()
    {
        echo "<pre>";
        var_dump($this->Config);
        echo "<pre>";
        echo "<pre>";
        var_dump($this->Database->getConnection());
        echo "<pre>";
    }
}