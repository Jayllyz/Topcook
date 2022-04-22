<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
var_dump($_POST);



/*$insertAvatar = $db->prepare("INSERT INTO AVATAR (colorBody, colorHair, colorEyes, colorHat, colorSweet, idUser) VALUES (:colorBody, :colorHair, :colorEyes, :colorHat, :colorSweet, :idUser)");
$insertAvatar->execute([
    'colorBody' => $_POST['body'],
    'colorHair' => $_POST['hair'],
    'colorEyes' => $_POST['eyes'],
    'colorHat' => $_POST['hat'],
    'colorSweet' => $_POST['sweet'],
    'idUser' => $_SESSION['id']
]);*/



?>
