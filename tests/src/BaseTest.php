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
    protected $base;

    protected function setUp()
    {
        $this->base = new Base();
    }

    public function testGetIndex()
    {
        $this->assertSame('Index', $this->base->getRoute());
    }

    public function testFilterString()
    {
        $filteredString = $this->base->filterString('12-<script type="text/javascript">3*/</script>');
        $this->assertSame($filteredString, '12-3*/');
    }

    public function testTestFilesIfExists()
    {
        $testFiles = [
            __DIR__ . '/../files/images/image1.png',
            __DIR__ . '/../files/images/image2.jpg',
            __DIR__ . '/../files/videos/video1.jpg',
        ];

        $this->assertTrue(file_exists($testFiles[0]));
        $this->assertTrue(file_exists($testFiles[1]));
    }
}
