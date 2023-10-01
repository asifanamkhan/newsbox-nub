<?php
namespace App\Helper;
use Intervention\Image\ImageManagerStatic as Intervention;
class ImageHelper{
    public static function saveBase64Image($image, $path, $weight, $height){

        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];
        $image_name = time() . '.' . $ext;
        $img = Intervention::make($image);
        $upload_path = 'public/images/slides/';
        $image_url = $upload_path . $image_name;
        $img->resize(800, 500);
        $img->save($image_url);

        return $image_url;
    }
}