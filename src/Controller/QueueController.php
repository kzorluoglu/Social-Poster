<?php
/**
 * Created by PhpStorm.
 * User: koray
 * Date: 14.12.18
 * Time: 15:49
 */

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Controller\Controller;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Controller\FacebookController;
use d8devs\socialposter\Controller\TwitterController;

class QueueController extends Controller
{
    /**
     * Sender Class
     * @var FacebookController|TwitterController
     */
    private $sender;

    /**
     * @var array
     */
    private $status;


    public function index()
    {
        $postModel = new Post();

        $posts = $postModel->getAll(['status' => 'created']);

        $this->render('queue/index', [
            'posts' => $posts
        ]);
    }

    public function run()
    {
        $postModel = new Post();
        $posts = $postModel->getAll(['status' => 'created']);
        $post = $postModel->getOne(['status' => 'created']);

        if ($post) {
            $this->status = $this->send($post);
        }
        
        if ($post == false) {
            $this->status['response'] = "All Created Posts sended";
            $this->status['error'] = null;
        }

        $this->render('queue/run', [
            'posts' => $posts,
            'status' => $this->status
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
            $this->sender = new InstagramController();
        }

        $response = $this->sender->send($post);

        if ($response['response']) {
            $post->status = "sended";
            $post->report = serialize($response);
        }
        if ($response['error']) {
            $post->status = "failed";
            $post->report = serialize($response);
        }

        $post->update();

        return $response;
    }
}
