<?php
// redimensionner l'image
if ($ext === "jpeg" || $ext === "jpg") {
    $image = imagecreatefromjpeg($destination);
    $width = imagesx($image);
    $height = imagesy($image);

    $new_width = 400;
    $new_height = 400;

    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled(
        $new_image,
        $image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $width,
        $height
    );

    imagejpeg($new_image, $destination);
    imagedestroy($new_image);
    imagedestroy($image);
} elseif ($ext === "png") {
    $image = imagecreatefrompng($destination);
    $width = imagesx($image);
    $height = imagesy($image);
    $new_width = 400;
    $new_height = 400;

    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled(
        $new_image,
        $image,
        0,
        0,
        0,
        0,
        $new_width,
        $new_height,
        $width,
        $height
    );
    imagepng($new_image, $destination);
    imagedestroy($new_image);
    imagedestroy($image);
}
