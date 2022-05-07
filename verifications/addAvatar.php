<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$body = $_POST['body'];
$hair = $_POST['hair'];
$eyes = $_POST['eyes'];
$hat = $_POST['hat'];
$sweet = $_POST['sweet'];
$beard = $_POST['beard'];

if($body != "start" && $hair != "start" && $eyes != "start" && $hat != "start" && $sweet != "start") {
    $insertAvatar = $db->prepare("INSERT INTO AVATAR (colorBody, colorHair, colorEyes, colorHat, colorSweet, colorMouth,colorBeard, hat, hair, eyes, beard, mouth, sweat, idUser) VALUES (:colorBody, :colorHair, :colorEyes, :colorHat, :colorSweet, :colorMouth, :colorBeard, :hat, :hair, :eyes, :beard, :mouth, :sweat, :idUser)");
    $insertAvatar->execute([
        'colorBody' => $body,
        'colorHair' => $hair,
        'colorEyes' => $eyes,
        'colorHat' => $hat,
        'colorSweet' => $sweet,
        'colorMouth' => "",
        'colorBeard' => $beard,
        'hat' => "",
        'hair' => "",
        'eyes' => "",
        'beard' => "",
        'mouth' => "",
        'sweat' => "",
        'idUser' => $_SESSION['id']
    ]);
    echo "<p class='alert alert-success mt-3'>Votre avatar a bien été modifié !</p>";
}else{
    echo "<p class='alert alert-danger mt-3'>Veuillez choisir des options</p>";
}
