<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 14.12.18
 * Time: 15:49
 */

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Controller\FacebookController;
use d8devs\socialposter\Controller\TwitterController;

class QueueController extends Base
{
    /**
     * Sender Class
     * @var [FacebookController|TwitterController]
     */
    private $sender;

    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getAll(['status' => 'created']);

        foreach ($posts as $post) {
            if ($post->for == "facebook_page") {
                $this->sender = new FacebookController();
            }

            if ($post->for == "twitter_account") {
                $this->sender = new TwitterController();
            }

            $this->sender->send($post);
        }

         $this->render('queue', [
            'posts' => $posts
         ]);
    }
}
