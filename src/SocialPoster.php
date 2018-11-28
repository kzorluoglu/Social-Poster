<?php

namespace d8devs\socialposter;

use Account\Twitter as TwitterAccount;
use d8devs\socialposter\Account\FacebookPage;
use Twitter;
use Facebook\Facebook;

/**
 * Description of SocialPoster
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class SocialPoster {

    protected $report;

    public function twitter($message, array $images = null) {

        $users = new TwitterAccount();

        foreach ($users->getAccounts() as $user) {
            $user = new Twitter($user->getConsumerKey(), $user->getConsumerSecret(), $user->getAccessToken(), $user->getAccessTokenSecret());
            if ($images) {
                $this->report[] = $user->send($message, $images);
            } else {
                $this->report[] = $user->send($message);
            }
        }
    }

    public function facebook($message, array $images = null) {

        $facebooks = new FacebookPage();
        foreach ($facebooks->getAccounts() as $facebook) {

            $fb = new Facebook([
                'app_id' => $facebook->getAppId(),
                'app_secret' => $facebook->getAppSecret(),
                'default_graph_version' => $facebook->getDefaultGraphVersion()
            ]);

            $fb->setDefaultAccessToken($facebook->getAccessToken());

            if ($images) {

                $this->report[] = $fb->sendRequest('POST', $facebook->getPage() . "/feed", [
                    'message' => $message,
                    'attached_media' => $this->facebookImageUpload($images, $fb, $facebook->getPage())
                ]);
            } else {
                $this->report[] = $fb->sendRequest('POST', $facebook->getPage() . "/feed", [
                    'message' => $message,
                ]);
            }
        }
    }

    public function getReport() {
        return $this->report;
    }

    function facebookImageUpload($images, $facebook, $page) {
        $post_images = array();
        foreach ($images as $image) {

            $response = $facebook->sendRequest('POST', $page . "/photos", [
                'source' => $facebook->fileToUpload($image),
                'published' => 'false'
            ]);
            $graphNode = $response->getGraphNode();
            $post_images[] = $graphNode['id'];
        }

        $attachedMedia = array();

        foreach ($post_images as $key => $post_image) {
            $attachedMedia[$key] = ['media_fbid' => $post_image];
        }
        return $attachedMedia;
    }

}
