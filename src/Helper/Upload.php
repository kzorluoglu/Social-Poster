<?php
namespace d8devs\socialposter\Helper;

/**
 * Description of Upload
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Upload
{

    protected $allowedTypes = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
    protected $files;
    protected $uploadedFiles;
    protected $uploadDirectory = __DIR__ . "/../../uploads/";

    public function __construct(array $files)
    {
        $this->files = $this->reArray($files);
    }

    public function setFiles(array $files)
    {

        $this->files = $this->reArray($files);
    }

    private function reArray($files)
    {
        $newArray = array();

        for ($i = 0; $i < count($files["name"]); $i++) {
            $newArray[$i]['name'] = $files['name'][$i];
            $newArray[$i]['type'] = $files['type'][$i];
            $newArray[$i]['tmp_name'] = $files['tmp_name'][$i];
            $newArray[$i]['error'] = $files['error'][$i];
            $newArray[$i]['size'] = $files['size'][$i];
        }
        return $newArray;
    }

    public function uploadFiles()
    {
        foreach ($this->files as $file) {
            if ($this->isAllowed($file['type'])) {
                $filepath = $this->uploadDirectory . basename($file['name']);
                try {
                    move_uploaded_file($file['tmp_name'], $filepath);
                    $this->uploadedFiles[] = $filepath;
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
        }
    }

    private function isAllowed($file_type)
    {
        return in_array($file_type, $this->allowedTypes);
    }

    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }
}
