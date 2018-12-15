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
        $pages = $facebookPage->getAll();

        $twitterAccount = new TwitterAccount();
        $twitterAccounts = $twitterAccount->getAll();

        $instagramAccount = new InstagramAccount();
        $instagramAccounts = $instagramAccount->getAll();

        if($_POST['facebook_page']){
            /**
             * @TODO: Facebook Save or Update
             */
        }
        if($_POST['twitter_account']){
            /**
             * @TODO: Twitter Save or Update
             */
        }
        if($_POST['instagram_account']){
            /**
             * @TODO: Instagram Save or Update
             */
        }

        $this->render('admin/index', [
            'facebook_pages' => $pages,
            'twitter_accounts' => $twitterAccounts,
            'instagram_accounts' => $instagramAccounts
        ]);
    }

}
