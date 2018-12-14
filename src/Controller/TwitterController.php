<?php

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;
use Twitter;

/**
 * Description of TwitterController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class TwitterController extends Base
{

    /**
     * @var string
     */
    private $response;

    public function send(Post $post)
    {

        $twitterAPI = new Twitter(
            'getConsumerKey',
            'getConsumerSecret',
            'getAccessToken',
            'getAccessTokenSecret'
        );
        if ($post->attachments) {
            try {
                $this->response = $twitterAPI->send($post->message, $post->attachments);
            } catch (\Exception $e) {
                $this->response = $e->getMessage();
            }
        }
        if (!$post->attachments) {
            try {
                $this->response = $twitterAPI->send($post->message);
            } catch (\Exception $e) {
                $this->response = $e->getMessage();
            }
        }

        return $this->response;
    }
}
