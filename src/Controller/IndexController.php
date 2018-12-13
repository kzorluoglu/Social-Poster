<?php
namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Controller\FacebookController;
use d8devs\socialposter\Controller\TwitterController;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Helper\Upload;
use d8devs\socialposter\Database;

/**
 * Description of IndexController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class IndexController extends Base
{

  /**
   * Sender Class
   * @var [FacebookController|TwitterController]
   */
    private $sender;

    public function index()
    {
        if ($_POST) {
            $formattedPostRequest = $this->formatPostRequest($_POST);
            $files = $this->uploadFiles($_FILES['files']);
            $posts = $this->createPosts($formattedPostRequest, $files);

            foreach ($posts as $post) {
                $this->send($post);
            }
            $this->prettyDebug($posts);
        }

        $this->render('index');
    }

    private function createPosts($formattedPostRequest, $files)
    {
        $posts = array();

        foreach ($formattedPostRequest as $post) {
            $post = new Post($post['for'], $post['target'], $post['message'], $files);
            $post->setReport('created_at', strtotime('now'));
            $posts[] = $post;
        }
        return $posts;
    }

    public function send(Post $post)
    {
        $createdAt = strtotime('now');

        if ($post->getTarget() == "facebook_page") {
            $this->sender = new FacebookController();
        }

        if ($post->getTarget() == "twitter_account") {
            $this->sender = new TwitterController();
        }

        if ($sender->send($post)) {
            $post->setReport('sended_at', strtotime('now'));
        }
    }

    public function formatPostRequest(array $posts)
    {
        $formattedPosts = array();
        for ($i = 0; $i < count($posts['facebook_page']); $i ++) {
            $formattedPosts[] = array(
                'for' => 'facebook_page',
                'target' => $posts['facebook_page'][$i],
                'message' => $posts['message']
            );
        }
        for ($i = 0; $i < count($posts['twitter_account']); $i ++) {
            $formattedPosts[] = array(
                'for' => 'twitter_account',
                'target' => $posts['twitter_account'][$i],
                'message' => $posts['message']
            );
        }
        for ($i = 0; $i < count($posts['instagram_account']); $i ++) {
            $formattedPosts[] = array(
                'for' => 'instagram_account',
                'target' => $posts['instagram_account'][$i],
                'message' => $posts['message']
            );
        }
        return $formattedPosts;
    }

    public function uploadFiles(array $files)
    {
        $upload = new Upload($files);
        $upload->uploadFiles();
        return $upload->getUploadedFiles();
    }
}
