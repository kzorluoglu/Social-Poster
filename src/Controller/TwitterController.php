<?php
namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;
use d8devs\socialposter\Helper\Upload;
use Twitter;

/**
 * Description of TwitterController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class TwitterController extends Base
{

    public function send(Post $post)
    {
        $twitterAPI = new Twitter(
            $user->getConsumerKey(),
            $user->getConsumerSecret(),
            $user->getAccessToken(),
            $user->getAccessTokenSecret()
        );
        if ($post->getAttachments()) {
            return $twitterAPI->send($post->getPost(), $post->getAttachments());
        } else {
            return $twitterAPI->send($post->getPost());
        }
    }
}
