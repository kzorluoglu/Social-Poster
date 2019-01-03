<?php

namespace D8devs\SocialPoster\Test;

use PHPUnit\Framework\TestCase;
use D8devs\SocialPoster\Base;

/**
 * Description of BaseTest
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class BaseTest extends TestCase
{

    /** @var \D8devs\SocialPoster\Base */
    protected $base;

    public function testAddNewClass()
    {
        $this->base->register('D8devs\SocialPoster\Config');

        $this->assertInstanceOf('D8devs\SocialPoster\Config', $this->base->Config);
    }

    public function testNotRegisteredClass()
    {

        $this->assertInstanceOf('Exception', $this->base->ThisNotExists);
    }

    protected function setUp()
    {
        $this->base = new Base();
    }
}
