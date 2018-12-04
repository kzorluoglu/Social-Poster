<?php
namespace d8devs\socialposter;

use PHPUnit\Framework\TestCase;
use d8devs\socialposter\Base;

/**
 * Description of BaseTest
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class BaseTest extends TestCase
{

    /** @var \d8devs\socialposter\Base */
    private static $base;

    public static function setUpBeforeClass()
    {
        self::$base = new Base();
    }

    public function testGetTwitter()
    {
        self::$base->setRoute('twitter');
        $this->assertInstanceOf('d8devs\socialposter\Controller\TwitterController', self::$base->get());
    }

    public function testGetFacebook()
    {
        self::$base->setRoute('facebook');
        $this->assertInstanceOf('d8devs\socialposter\Controller\FacebookController', self::$base->get());
    }

    public function testGetIndex()
    {
        self::$base->setRoute('');
        $this->assertInstanceOf('d8devs\socialposter\Controller\IndexController', self::$base->get());
    }

    public function testFilterString()
    {
        $filteredString = self::$base->filterString('12-<script type="text/javascript">3*/</script>');
        $this->assertSame($filteredString, '12-3*/');
    }
}
