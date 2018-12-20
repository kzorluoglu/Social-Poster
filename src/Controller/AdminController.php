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
class AdminController extends Controller
{

    public function index()
    {
        $facebookPage = new FacebookPage();
        $facebookPages = $facebookPage->getAll();

        $twitterAccount = new TwitterAccount();
        $twitterAccounts = $twitterAccount->getAll();

        $instagramAccount = new InstagramAccount();
        $instagramAccounts = $instagramAccount->getAll();


        if (isset($_POST['facebook_page|insert'])) {
            $this->insertFacebookPage();
        }

        if (isset($_POST['facebook_page|update'])) {
            $this->updateFacebookPage();
        }

        if (isset($_POST['facebook_page|delete'])) {
            $this->deleteFacebookPage();
        }

        if (isset($_POST['twitter_account|insert'])) {
            $this->insertTwitterAccount();
        }

        if (isset($_POST['twitter_account|update'])) {
            $this->updateTwitterAccount();
        }

        if (isset($_POST['twitter_account|delete'])) {
            $this->deleteTwitterAccount();
        }

        if (isset($_POST['instagram_account|insert'])) {
            $this->insertInstagramAccount();
        }

        if (isset($_POST['instagram_account|update'])) {
            $this->updateInstagramAccount();
        }

        if (isset($_POST['instagram_account|delete'])) {
            $this->deleteInstagramAccount();
        }

        $this->render('admin/index', [
            'facebook_pages' => $facebookPages,
            'twitter_accounts' => $twitterAccounts,
            'instagram_accounts' => $instagramAccounts
        ]);
    }

    /**
     * Insert Facebook Page
     */
    private function insertFacebookPage()
    {
        $account = new FacebookPage();
        $account->description = $_POST['description'];
        $account->page = $_POST['page'];
        $account->app_id = $_POST['app_id'];
        $account->app_secret = $_POST['app_secret'];
        $account->default_graph_version = $_POST['default_graph_version'];
        $account->access_token = $_POST['access_token'];
        $account->save();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Update Facebook Page
     */
    private function updateFacebookPage()
    {
        $find = new FacebookPage();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->description = $_POST['description'];
        $account->page = $_POST['page'];
        $account->app_id = $_POST['app_id'];
        $account->app_secret = $_POST['app_secret'];
        $account->default_graph_version = $_POST['default_graph_version'];
        $account->access_token = $_POST['access_token'];
        $account->update();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Delete Facebook Page
     */
    private function deleteFacebookPage()
    {
        $find = new FacebookPage();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->remove();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Insert Twitter Account
     */
    private function insertTwitterAccount()
    {
        $account = new TwitterAccount();
        $account->description = $_POST['description'];
        $account->consumer_key = $_POST['consumer_key'];
        $account->consumer_secret = $_POST['consumer_secret'];
        $account->access_token = $_POST['access_token'];
        $account->access_token_secret = $_POST['access_token_secret'];
        $account->save();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Update Twitter Account
     */
    private function updateTwitterAccount()
    {
        $find = new TwitterAccount();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->description = $_POST['description'];
        $account->consumer_key = $_POST['consumer_key'];
        $account->consumer_secret = $_POST['consumer_secret'];
        $account->access_token = $_POST['access_token'];
        $account->access_token_secret = $_POST['access_token_secret'];
        $account->update();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Delete Twitter Account
     */
    private function deleteTwitterAccount()
    {
        $find = new TwitterAccount();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->remove();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Insert Instagram Account
     */
    private function insertInstagramAccount()
    {
        $account = new InstagramAccount();
        $account->description = $_POST['description'];
        $account->username = $_POST['username'];
        $account->password = $_POST['password'];
        $account->save();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Update Instagram Account
     */
    private function updateInstagramAccount()
    {
        $find = new InstagramAccount();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->description = $_POST['description'];
        $account->username = $_POST['username'];
        $account->password = $_POST['password'];
        $account->update();
        $this->redirect('index.php?page=admin');
    }

    /**
     * Delete Instagram Account
     */
    private function deleteInstagramAccount()
    {
        $find = new InstagramAccount();
        $account = $find->getOne(['id' => $_POST['id']]);
        $account->remove();
        $this->redirect('index.php?page=admin');
    }
}
