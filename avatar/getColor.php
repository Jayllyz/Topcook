<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

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
