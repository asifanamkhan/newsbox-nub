<?php
namespace App\Helper;
use Intervention\Image\ImageManagerStatic as Intervention;
class ImageHelper{
    public static function saveBase64Image($image, $path, $weight, $height){

        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];
        $image_name = uniqid('img','true') . '.' . $ext;
        $img = Intervention::make($image);
        $upload_path = $path;
        $image_url = $upload_path . $image_name;
        $img->resize($weight, $height);
        $img->save($image_url);

        return $image_url;
    }
}