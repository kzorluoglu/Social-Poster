<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 14.12.18
 * Time: 17:28
 */

namespace d8devs\socialposter\tests\Controller;

use PHPUnit\Framework\TestCase;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Controller\QueueController;

class QueueControllerTest extends TestCase
{

    /** @var QueueController */
    private $controller;


    protected function setUp()
    {
        $this->controller = new QueueController();
    }

    public function testTwitterSend()
    {

        $post = new Post();
        $post->for = 'twitter_account';
        $post->target = '1';
        $post->message = 'Test Twitt with Attachments';

        $sendedPost = $this->controller->send($post);

        $this->assertSame($sendedPost, 'Invalid or expired token.');
    }


    public function testFacebookSend()
    {
        $post = new Post();
        $post->for = 'facebook_page';
        $post->target = '1';
        $post->message = 'Test Facebook Post with Attachments';

        $sendedPost = $this->controller->send($post);

        $this->assertSame($sendedPost, 'Invalid OAuth access token.');
    }
}
