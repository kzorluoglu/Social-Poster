<?php
namespace d8devs\socialposter\Controller;

use d8devs\socialposter\Base;
use d8devs\socialposter\SocialPoster;
use d8devs\socialposter\Helper\Upload;

/**
 * Description of TwitterController
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class TwitterController extends Base
{
    public function __construct()
    {
        $this->index();
    }

    public function index()
    {
        $error_message = "";
        $reports = "";

        if ($_POST) {
            if (empty($_POST['message'])) {
                $error_message = "Please do not empty the Message field.";
            }

            if ($error_message == "") {
                $poster = new SocialPoster();

                if (isset($_FILES['pictures'])) {
                    $upload = new Upload();
                    $upload->setFiles($_FILES['pictures']);
                    $upload->uploadFiles();
                    $poster->twitter($_POST['message'], $upload->getUploadedFiles());
                } else {
                    $poster->twitter($_POST['message']);
                }
                $reports = $poster->getReport();
            }
        }

        $this->render('twitter', array(
            'error_message' => $error_message,
            'reports' => $reports
        ));
    }
}
