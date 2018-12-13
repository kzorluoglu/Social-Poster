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

    /** @var array d8devs\socialposter\Model\Post[] */
    private $posts;

    /** @var Database **/
    private $db;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function index()
    {
        if ($_POST) {
            $formattedPostRequest = $this->formatPostRequest($_POST);
            $files = $this->uploadFiles($_FILES['files']);
            $posts = $this->createPosts($formattedPostRequest, $files);

            foreach ($posts as $post) {
                $this->send($post);
            }
        }

        $this->render('index');
    }

    private function createPosts($formattedPostRequest, $files)
    {
        $posts = array();

        foreach ($formattedPostRequest as $post) {
            $posts[] = new Post($post['for'], $post['target'], $post['message'], $files);
        }
        return $posts;
    }

    public function send(Post $post)
    {
        $insert = "INSERT INTO posts (for, target, message, attachments, status, sended_at, created_at)
                VALUES (:for, :target, :message, :attachments, :status, :sended_at, :created_at)";

        $statment = $this->db->prepare($insert);
        $statment->bindParam(':for', $for);
        $statment->bindParam(':target', $target);
        $statment->bindParam(':message', $message);
        $statment->bindParam(':attachments', $attachments);
        $statment->bindParam(':status', $status);
        $statment->bindParam(':sended_at', $sendedAt);
        $statment->bindParam(':created_at', $createdAt);

        $for = $post->getFor();
        $target = $post->getTarget();
        $message = $post->getMessage();
        $attachments = serialize($post->getAttachments());
        $createdAt = strtotime('now');

        if ($post->getTarget() == "facebook_page") {
            $sender = new FacebookController();
            $status = $sender->send($post);
        }

        if ($post->getTarget() == "twitter_account") {
            $sender = new TwitterController();
            $status = $sender->send($post);
        }

        if ($status) {
            $sendedAt = strtotime('now');
        }
        $statment->execute();

        return $status;
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
