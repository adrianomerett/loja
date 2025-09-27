<?php

require_once ROOT_LIBRARY . 'vendor/autoload.php';

use \Gumlet\ImageResize;

class Img
{

    public static function resizeImage($file, $patchdestination, $name, $width, $height)
    {
        try {
            $gunlet = new ImageResize($file);
            $gunlet->resizeToBestFit($width, $height);
            $gunlet->save($patchdestination . $name);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
