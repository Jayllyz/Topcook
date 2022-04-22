<?php
session_start();
include '../includes/db.php';
$body = $_POST['body'];
$hair = $_POST['hair'];
$eyes = $_POST['eyes'];
$hat = $_POST['hat'];
$sweet = $_POST['sweet'];
$beard = $_POST['beard'];

if($body != "start" && $hair != "start" && $eyes != "start" && $hat != "start" && $sweet != "start") {
    $insertAvatar = $db->prepare("INSERT INTO AVATAR (colorBody, colorHair, colorEyes, colorHat, colorSweet, colorBeard, idUser) VALUES (:colorBody, :colorHair, :colorEyes, :colorHat, :colorSweet, :colorBeard, :idUser)");
    $insertAvatar->execute([
        'colorBody' => $body,
        'colorHair' => $hair,
        'colorEyes' => $eyes,
        'colorHat' => $hat,
        'colorSweet' => $sweet,
        'colorBeard' => $beard,
        'idUser' => $_SESSION['id']
    ]);
    echo "<p class='alert alert-success mt-3'>Votre avatar a bien été modifié !</p>";
}else{
    echo "<p class='alert alert-danger mt-3'>Veuillez choisir des options</p>";
}


?>
