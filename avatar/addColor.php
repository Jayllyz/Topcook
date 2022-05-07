<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
if(!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}
include "../includes/db.php";
$idUser = $_SESSION["id"];
$colorBody = $_POST["colorBody"];
$colorHair = $_POST["colorHair"];
$colorHat = $_POST["colorHat"];
$colorSweat = $_POST["colorSweat"];
$colorEyes = $_POST["colorEyes"];
$colorBeard = $_POST["colorBeard"];

$updateColor = $db->query(
  "UPDATE AVATAR SET colorBody = '$colorBody', colorHair = '$colorHair' , colorHat = '$colorHat' , colorSweet = '$colorSweat' , colorEyes = '$colorEyes' , colorBeard = '$colorBeard' WHERE idUser = " .
    $idUser
);
