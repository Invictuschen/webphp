<?php
/**
 * Created by PhpStorm.
 * User: invictus
 * Date: 2017/12/20
 * Time: 下午1:52
 */
function LoadJpeg($imgname)
{
    /* 尝试打开 */
    $im = @imagecreatefromjpeg($imgname);

    /* See if it failed */
    if(!$im)
    {
        /* Create a black image */
        $im  = imagecreatetruecolor(50, 50);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 50, 50, $bgc);

        /* Output an error message */
        imagestring($im, 2, 2, 20, 'No image ' . $imgname, $tc);
    }

    return $im;
}

header('Content-Type: image/jpeg');

$img = LoadJpeg('Profile Image');

imagejpeg($img);
imagedestroy($img);