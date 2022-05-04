<?php
session_start();
include "../includes/db.php";

$sql = "SELECT colorHair, colorBody, colorHat, colorSweet, colorEyes, colorBeard FROM AVATAR WHERE idUser = " . $_SESSION["id"];
$sql = $db->query($sql);
$color = $sql->fetch(PDO::FETCH_ASSOC);

    $colorHair = $color["colorHair"];
    $colorBody = $color["colorBody"];
    $colorHat = $color["colorHat"];
    $colorSweet = $color["colorSweet"];
    $colorEyes = $color["colorEyes"];
    $colorBeard = $color["colorBeard"];
    echo $colorBody;
    echo ",";
    echo $colorHair;
    echo ",";
    echo $colorHat;
    echo ",";
    echo $colorSweet;
    echo ",";
    echo $colorEyes;
    echo ",";
    echo $colorBeard;
