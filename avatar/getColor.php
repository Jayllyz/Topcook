<?php
session_start();
include "../includes/db.php";
if(!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}

$sql =
  "SELECT colorHair, colorHat, colorSweet, colorEyes, colorBeard, colorBody FROM AVATAR WHERE idUser = " .
  $_SESSION["id"];
$sql = $db->query($sql);
$color = $sql->fetch(PDO::FETCH_ASSOC);

$colorHair = $color["colorHair"];
$colorHat = $color["colorHat"];
$colorSweet = $color["colorSweet"];
$colorEyes = $color["colorEyes"];
$colorBeard = $color["colorBeard"];
$colorBody = $color["colorBody"];

echo $colorHair;
echo ",";
echo $colorHat;
echo ",";
echo $colorSweet;
echo ",";
echo $colorEyes;
echo ",";
echo $colorBeard;
echo ",";
echo $colorBody;
