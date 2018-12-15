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

    protected function setUp()
    {
         $this->base = new Base();
    }

    public function testRun()
    {
        $this->base->run();

        $this->assertSame('d8devs\socialposter\Controller\IndexController', $this->base->getPageController());
    }
}
