<?php

if(!function_exists('getImagePath')){
    function getImagePath($img_path, $width = null, $height = null, $type = "thumb")
    {
        return app('Modules\Core\Services\ImageServices')->getImagePath($img_path, $width, $height, $type);
    }
}

if(!function_exists('_')){
    function _($text)
    {
        return $text;
    }
}

