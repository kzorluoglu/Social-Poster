<?php

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Model\TwitterAccount;
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

    /**
     * @var string
     */
    private $error;

    public function send(Post $post)
    {
        $twitterAccount = new TwitterAccount();
        $twitter = $twitterAccount->getOne(['id' => $post->target]);

        $twitterAPI = new Twitter(
            $twitter->consumer_key,
            $twitter->consumer_secret,
            $twitter->access_token,
            $twitter->access_token_secret
        );


        if (unserialize($post->attachments)) {
            try {
                $this->response = $twitterAPI->send($post->message, $post->attachments);
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }
        if (!unserialize($post->attachments)) {
            try {
                $this->response = $twitterAPI->send($post->message);
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        return [
            'response' => $this->response,
            'error' => $this->error
        ];
    }
}
