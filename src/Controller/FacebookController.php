<?php
namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Model\FacebookPage;
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
    /**
     * @var string
     */
    private $error;

    public function send(Post $post)
    {
        $facebookPage = new FacebookPage();
        $page = $facebookPage->getOne(['id' => $post->target]);


        $fb = new Facebook([
            'app_id' => $page->app_id,
            'app_secret' => $page->app_secret,
            'default_graph_version' => $page->default_graph_version
        ]);

        $fb->setDefaultAccessToken('getAccessToken');

        if (unserialize($post->attachments)) {
            try {
                $this->response = $fb->sendRequest('POST', $page->page . "/feed", [
                    'message' => $post->message,
                    'attached_media' => $this->imageUpload(unserialize($post->attachments), $fb, $page->page)
                ]);
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }


        if (!unserialize($post->attachments)) {
            try {
                $this->response =  $fb->sendRequest('POST', $page->page . "/feed", [
                    'message' => $post->message
                ]);
            } catch (\Exception $e) {
                $this->error =  $e->getMessage();
            }
        }

        return [
            'response' => $this->response,
            'error' => $this->error
            ];
    }

    /**
     * @param $images
     * @param $facebook
     * @param $page
     * @return array
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
