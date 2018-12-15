<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 14.12.18
 * Time: 17:28
 */

namespace d8devs\socialposter\tests\Controller;

use d8devs\socialposter\Model\FacebookPage;
use d8devs\socialposter\Model\TwitterAccount;
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

        $createdSender = new TwitterAccount();
        $createdSender->consumer_key = 'null';
        $createdSender->consumer_secret = 'null';
        $createdSender->access_token = 'null';
        $createdSender->access_token_secret = 'null';


        $post = new Post();
        $post->for = 'twitter_account';
        $post->target = serialize($createdSender->columns);
        $post->message = 'Test Twitt';

        $sendedPost = $this->controller->send($post);

        $this->assertSame($sendedPost, ['response' => null, 'error' => 'Invalid or expired token.']);
    }


    public function testFacebookSend()
    {
        $createdSender = new FacebookPage();
        $createdSender->page = 'test';
        $createdSender->app_id = 'null';
        $createdSender->app_secret = 'null';
        $createdSender->default_graph_version = 'null';
        $createdSender->access_token = 'null';

        $post = new Post();
        $post->for = 'facebook_page';
        $post->target = serialize($createdSender->columns);
        $post->message = 'Test Facebook Post';

        $sendedPost = $this->controller->send($post);

        $this->assertSame($sendedPost, ['response' => null, 'error' => 'Invalid OAuth access token.']);
    }
}
