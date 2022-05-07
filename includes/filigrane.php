<?php

// Chargement des image dans des variables

$logo = ImageCreateFromPNG("https://topcook.site/test/logo_topcook.png");

$img = ImageCreateFromJPEG($filename);

// Superposition des images

//imagecopy($img, $logo, 100, 110, 0, 0, imagesx($logo), imagesy($logo));
imagecopyresized($img, $logo, 145, 140, 0, 0, 200, 200, 300, 300);

// Un header spécifique

header("Content-type: image/png");

// Maintenant, envoyer les données de l'image

imagepng($img);

// Libérons la mémoire

imagedestroy($img);

?>
