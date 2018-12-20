<?php

namespace d8devs\socialposter\tests\Controller;

use PHPUnit\Framework\TestCase;
use d8devs\socialposter\Controller\IndexController;

/**
 * Description of IndexControllerTest
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class IndexControllerTest extends TestCase
{

    /** @var array Fake $_POST Request */
    private $fakePOST = array(
        'message' => 'test',
        'link' => null,
        'facebook_page' => array(
            0 => 1,
            1 => 2
        ),
        'twitter_account' => array(
            0 => 1
        ),
        'instagram_account' => array(
            0 => 1,
            1 => 1
        )
    );

    /** @var array Fake $_FILE Request */
    private $fakeFILE = array(
        'name' => array(
            0 => 'image1.png',
            1 => 'image2.jpg',
        ),
        'type' => array(
            0 => 'image/png',
            1 => 'image/jpeg',
        ),
        'tmp_name' => array(
            0 => __DIR__ . '/../../files/images/image1.png',
            1 => __DIR__ . '/../../files/images/image2.jpg',
        ),
        'error' => array(
            0 => 0,
            1 => 0,
        ),
        'size' => array(
            0 => 677,
            1 => 9111,
        ),
    );

    /** @var IndexController */
    private $controller;

    public function testformatPostRequest()
    {
        $posts = $this->controller->formatPostRequest($this->fakePOST);

        $this->assertSame($this->fakePOST['facebook_page'][0], $posts[0]['target']);
        $this->assertSame($this->fakePOST['twitter_account'][0], $posts[3]['target']);
        $this->assertSame($this->fakePOST['instagram_account'][1], $posts[4]['target']);
    }

    protected function setUp()
    {

        $this->controller = new IndexController();
    }
}
