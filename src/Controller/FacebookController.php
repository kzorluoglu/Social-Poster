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

    public function send(Post $post)
    {
        $facebookInformation = $this->getFacebookInformation($post);

        $fb = new Facebook([
            'app_id' => $facebookInformation->getAppId(),
            'app_secret' => $facebookInformation->getAppSecret(),
            'default_graph_version' => $facebookInformation->getDefaultGraphVersion()
        ]);

        $fb->setDefaultAccessToken($facebookInformation->getAccessToken());

        if ($post->getAttachments()) {
            $this->report[] = $fb->sendRequest('POST', $facebookInformation->getPage() . "/feed", [
                'message' => $post->getPost(),
                'attached_media' => $this->imageUpload($post->getAttachments(), $fb, $facebookInformation->getPage())
            ]);
        } else {
            $this->report[] = $fb->sendRequest('POST', $facebookInformation->getPage() . "/feed", [
                'message' => $post->getPost()
            ]);
        }
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
