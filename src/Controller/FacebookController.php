<?php
namespace d8devs\socialposter\Controller;

use Facebook\Facebook;
use d8devs\socialposter\Base;
use d8devs\socialposter\Database;
use d8devs\socialposter\Model\Post;

/**
 * Description of FacebookController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class FacebookController
{

    /** @var Database **/
    private $db;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
    }

    public function send(Post $post)
    {
        $facebookInformation = $this->getFacebookInformation($post);

        $fb = new Facebook([
            'app_id' => $facebook->getAppId(),
            'app_secret' => $facebook->getAppSecret(),
            'default_graph_version' => $facebook->getDefaultGraphVersion()
        ]);

        $fb->setDefaultAccessToken($facebook->getAccessToken());

        if ($post->getAttachments()) {
            $this->report[] = $fb->sendRequest('POST', $facebook->getPage() . "/feed", [
                'message' => $post->getPost(),
                'attached_media' => $this->imageUpload($post->getAttachments(), $fb, $facebook->getPage())
            ]);
        } else {
            $this->report[] = $fb->sendRequest('POST', $facebook->getPage() . "/feed", [
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
