<?php

namespace d8devs\socialposter\tests;

define('CURRENT_ENV', 'development');

/**
 * Description of BaseTest
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class BaseTest
{

    /** @var \d8devs\socialposter\Base */
    protected $base;

    public function testIndexController()
    {
        $this->base->run();

        $this->assertSame('d8devs\socialposter\Controller\IndexController', $this->base->getPageController());
    }

    public function testQueueController()
    {
        $this->base->setPage('queue');

        $this->assertSame('d8devs\socialposter\Controller\QueueController', $this->base->getPageController());
    }

    public function testQueueRunController()
    {
        $this->base->setPage('queue');

        $this->assertSame('d8devs\socialposter\Controller\QueueController', $this->base->getPageController());
    }

    public function testAdminController()
    {
        $this->base->setPage('queue');

        $this->assertSame('d8devs\socialposter\Controller\AdminController', $this->base->getPageController());
    }

    protected function setUp()
    {
        $this->base = new Base();
    }
}
