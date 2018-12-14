<?php
namespace d8devs\socialposter\Controller;

use Facebook\Facebook;
use d8devs\socialposter\Base;
use d8devs\socialposter\Model\Post;

/**
 * Description of FacebookController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class FacebookController
{
    /**
     * @var string
     */
    private $response;

    public function send(Post $post)
    {

        $fb = new Facebook([
            'app_id' => 'getAppId',
            'app_secret' => 'app_secret',
            'default_graph_version' => 'default_graph_version'
        ]);

        $fb->setDefaultAccessToken('getAccessToken');

        if ($post->attachments) {
            try {
                $this->response = $fb->sendRequest('POST', 'page' . "/feed", [
                    'message' => $post->message,
                    'attached_media' => $this->imageUpload(unserialize($post->attachments), $fb, 'page')
                ]);
            } catch (\Exception $e) {
                $this->response = $e->getMessage();
            }
        }


        if (!$post->attachments) {
            try {
                $this->response =  $fb->sendRequest('POST', 'page' . "/feed", [
                    'message' => $post->message
                ]);
            } catch (\Exception $e) {
                $this->response =  $e->getMessage();
            }
        }

        return $this->response;
    }

    private function getFacebookInformation(Post $post)
    {
        /**
         * @TODO: Get Facebook Api Infos
         */
    }

    /**
     * Upload Images to Facebook
     *
     *
     * @param array $images
     * @param Facebook $facebook
     * @param string $page
     *
     * @return array media_fbid[]
     */
    private function imageUpload($images, $facebook, $page)
    {
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
            $attachedMedia[$key] = [
                'media_fbid' => $post_image
            ];
        }
        return $attachedMedia;
    }
}
