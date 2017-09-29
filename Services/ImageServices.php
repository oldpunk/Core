<?php
namespace Modules\Core\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

/**
 * Optionally may use https://unsplash.it/
 *
 * Class ImageServices
 * @package Modules\Core\Services
 */
class ImageServices
{
    public function getImagePath($path, $width = null, $height = null, $type = "thumb")
    {
        $images_path = config('image.images_path');
        $path = ltrim($path, "/");

        //returns the original image if isn't passed width and height
        if (is_null($width) && is_null($height)) {
            return url("{$images_path}/" . $path);
        }

        //if thumbnail exist returns it
        if (File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path))) {
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        }

        //If original image doesn't exists returns a default image which shows that original image doesn't exist.
        if (!File::exists(public_path("{$images_path}/" . $path))) {

            /*
             * 2 ways
             */

            //1. recursive call for the default image
            //return $this->getImageThumbnail("error/no-image.png", $width, $height, $type);

            //2. returns an image placeholder generated from placehold.it
            return "http://placehold.it/{$width}x{$height}";
        }

        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
        $contentType = \mime_content_type(public_path("{$images_path}/" . $path));

        if (in_array($contentType, $allowedMimeTypes)) { //Checks if is an image

            $image = Image::make(public_path("{$images_path}/" . $path));

            switch ($type) {
                case "crop": {
                    $image->fit($width, $height, function ($constraint) {
                        $constraint->upsize();
                    });
                    break;
                }
                case "resize":
                    $image_height = $image->getHeight();
                    $image_width = $image->getWidth();
                    $new_height = $height;
                    $new_width = $width;

                    if($image_height > $image_width){
                        $new_width = null;
                    }else{
                        $new_height = null;
                    }

                    $image->resize($new_width, $new_height, function ($constraint) {
//                        //keeps aspect ratio and sets black background
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    break;

                case "thumb":
                    $image_height = $image->getHeight();
                    $image_width = $image->getWidth();
                    $new_height = $height;
                    $new_width = $width;

                    if($image_height > $image_width){
                        $new_width = null;
                    }else{
                        $new_height = null;
                    }

                    $image->resize($new_width, $new_height, function ($constraint) {
                        //keeps aspect ratio and sets black background
                        $constraint->aspectRatio();
                    });
                    $image->resizeCanvas($width, $height, 'center', false, 'rgba(255, 255, 255, 0)'); //gets the center part
                    break;

                case "resizeCanvas": {
                    $image->resizeCanvas($width, $height, 'center', false, 'rgba(255, 255, 255, 0)'); //gets the center part
                }
            }

            //relative directory path starting from main directory of images
            $dir_path = (dirname($path) == '.') ? "" : dirname($path);

            //Create the directory if it doesn't exist
            if (!File::exists(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path))) {
                File::makeDirectory(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $dir_path), 0775, true);
            }

            //Save the thumbnail
            $image->save(public_path("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path));

            //return the url of the thumbnail
            return url("{$images_path}/thumbs/" . "{$width}x{$height}/" . $path);
        } else {

            //return a placeholder image
            return "http://placehold.it/{$width}x{$height}";
        }
    }
}