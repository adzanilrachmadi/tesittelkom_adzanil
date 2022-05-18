<?php
namespace ImageUpload;
class Images
{

    function upload_image()
    {
        if (isset($_POST["image"])) {
            echo json_encode(Images::save_image($_POST["image"]));
        } else {
            echo json_encode(getResponse(false, 'Invalid image data.'));
        }
    }

    static function save_image(string $data, string $path = "", string $name = ""): array
    {
        if ($path == "") {
            $path = APPPATH . "/../assets/img/uploads/";
        }
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                return getResponse(false, 'Invalid image type.');
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);

            if ($data === false) {
                return getResponse(false, 'Image decode failed');
            }
            if ($name == "") {
                $name = date("YmdHis") . ".$type";
            }
            if (!file_put_contents("$path/$name", $data)) {
                return getResponse(false, 'Filed to upload file');
            }
            return getResponseWithData(true, 'Upload image success.', array("filepath" => $path, "filename" => $name));
        }
        return getResponse(false, 'Invalid image data.');
    }
}
