<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
include "../includes/functions.php";
$idUser = $_SESSION['id'];

    $avatar = $db->query("SELECT colorBody, colorHair, colorEyes, colorHat, colorSweet, colorMouth, colorBeard, hat, hair, eyes, mouth, sweat FROM AVATAR WHERE idUser = ".$idUser);
    $avatar = $avatar->fetch();
    $selectImgHat = getAvatar($db,'hat', $idUser);
    $selectImgHair = getAvatar($db,'hair', $idUser);
    $selectImgEyes = getAvatar($db,'eyes', $idUser);
    $selectImgMouth = getAvatar($db,'mouth', $idUser);
    $selectImgSweat = getAvatar($db,'sweat', $idUser);
    $selectImgBeard = getAvatar($db,'beard', $idUser);

       if( $selectImgHat !== FALSE) {
           echo "<div id='hat'>";
           echo $selectImgHat;
           echo "</div>";
       }
        if( $selectImgEyes !== FALSE) {
            echo "<div id='eyes'>";
            echo $selectImgEyes;
            echo "</div>";
        }
        if( $selectImgHair !== FALSE && $selectImgHat === FALSE) {
            echo "<div id='hair'>";
            echo $selectImgHair;
            echo "</div>";
        }
        if( $selectImgMouth !== FALSE) {
            echo "<div id='mouth'>";
            echo $selectImgMouth;
            echo "</div>";
        }
        if( $selectImgBeard !== FALSE) {
            echo "<div id='beard'>";
            echo $selectImgBeard;
            echo "</div>";
        }
        if( $selectImgSweat !== FALSE) {
            echo "<div id='sweat'>";
            echo $selectImgSweat;
            echo "</div>";
        }



?>
