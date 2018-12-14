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
     * @var FacebookController|TwitterController
     */
    private $sender;

    public function index()
    {
        $postModel = new Post();
        $post = $postModel->getOne(['status' => 'created']);

        if ($post) {
            $this->send($post);
        } else {
            $finished = "All Posts sended";
        }


        $posts = $postModel->getAll(['status' => 'created']);

         $this->render('queue', [
            'posts' => $posts,
             'finished' => $finished
         ]);
    }

    public function send(Post $post)
    {


        if ($post->for == "facebook_page") {
            $this->sender = new FacebookController();
        }

        if ($post->for == "twitter_account") {
            $this->sender = new TwitterController();
        }

        if ($post->for == "instagram_account") {
            /**
             * @TODO : Create Instagram Controller
             */
            $this->sender = new FacebookController();
        }


        $sendResponse = $this->sender->send($post);

        if ($sendResponse) {
            $post->status = "sended";
        } else {
            $post->status = "failed";
        }

         $post->update();


        return $sendResponse;
    }
}
