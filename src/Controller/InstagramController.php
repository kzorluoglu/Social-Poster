<?php

namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;
use InstagramAPI\Instagram;
use InstagramAPI\Media\Photo\InstagramPhoto;

/**
 * Description of InstagramController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class InstagramController extends Base
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
        $target = unserialize($post->target);

        Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

        $instagram = new Instagram(true, false);

        if (unserialize($post->attachments)) {
            try {
                $instagram->login($target['username'], $target['password']);

                foreach (unserialize($post->attachments) as $photo) {
                    try {
                        $photo = new InstagramPhoto($photo);
                        $this->response = $instagram->timeline->uploadPhoto(
                            $photo->getFile(),
                            ['caption' => $post->message]
                        );
                    } catch (\Exception $e) {
                        $this->error = $e->getMessage();
                    }
                }
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
