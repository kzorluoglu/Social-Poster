<?php

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Model\FacebookPage;
use d8devs\socialposter\Model\InstagramAccount;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Helper\Upload;
use d8devs\socialposter\Model\TwitterAccount;

/**
 * Description of IndexController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class IndexController extends Controller
{

    public function index()
    {
        $facebookPage = new FacebookPage();
        $pages = $facebookPage->getAll();

        $twitterAccount = new TwitterAccount();
        $twitterAccounts = $twitterAccount->getAll();

        $instagramAccount = new InstagramAccount();
        $instagramAccounts = $instagramAccount->getAll();

        if ($_POST) {
            $formattedPostRequest = $this->formatPostRequest($_POST);
            $files = $this->uploadFiles($_FILES['files']);
            $this->createPosts($formattedPostRequest, $files);
            $this->redirect('index.php?page=queue');
        }

        $this->render('index', [
            'facebook_pages' => $pages,
            'twitter_accounts' => $twitterAccounts,
            'instagram_accounts' => $instagramAccounts
        ]);
    }

    public function formatPostRequest(array $posts)
    {
        $formattedPosts = array();
        for ($i = 0; $i < count($posts['facebook_page']); $i++) {
            $formattedPosts[] = array(
                'for' => 'facebook_page',
                'target' => $posts['facebook_page'][$i],
                'message' => $posts['message'],
                'link' => $posts['link']
            );
        }
        for ($i = 0; $i < count($posts['twitter_account']); $i++) {
            $formattedPosts[] = array(
                'for' => 'twitter_account',
                'target' => $posts['twitter_account'][$i],
                'message' => $posts['message'],
                'link' => $posts['link']
            );
        }
        for ($i = 0; $i < count($posts['instagram_account']); $i++) {
            $formattedPosts[] = array(
                'for' => 'instagram_account',
                'target' => $posts['instagram_account'][$i],
                'message' => $posts['message'],
                'link' => $posts['link']
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

    private function createPosts($formattedPostRequest, $files)
    {

        foreach ($formattedPostRequest as $post) {
            $newPost = new Post();
            $newPost->for = $post['for'];

            $target = "";

            if ($post['for'] == 'facebook_page') {
                $getTarget = new FacebookPage();
                $target = $getTarget->getOne(['id' => $post['target']]);
            }

            if ($post['for'] == 'twitter_account') {
                $getTarget = new TwitterAccount();
                $target = $getTarget->getOne(['id' => $post['target']]);
            }

            if ($post['for'] == 'instagram_account') {
                $getTarget = new InstagramAccount();
                $target = $getTarget->getOne(['id' => $post['target']]);
            }

            $newPost->target = serialize($target->columns);
            $newPost->message = $post['message'];
            $newPost->link = $post['link'];
            $newPost->attachments = serialize($files);
            $newPost->created_at = strtotime('now');
            $newPost->status = "created";
            $newPost->save();
        }
    }
}
