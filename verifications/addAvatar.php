<?php
session_start();
include '../includes/db.php';
$body = $_POST['body'];
$hair = $_POST['hair'];
$eyes = $_POST['eyes'];
$hat = $_POST['hat'];
$sweet = $_POST['sweet'];

if($body != "start" && $hair != "start" && $eyes != "start" && $hat != "start" && $sweet != "start") {
    $insertAvatar = $db->prepare("INSERT INTO AVATAR (colorBody, colorHair, colorEyes, colorHat, colorSweet, idUser) VALUES (:colorBody, :colorHair, :colorEyes, :colorHat, :colorSweet, :idUser)");
    $insertAvatar->execute([
        'colorBody' => $body,
        'colorHair' => $hair,
        'colorEyes' => $eyes,
        'colorHat' => $hat,
        'colorSweet' => $sweet,
        'idUser' => $_SESSION['id']
    ]);
}else{
    echo "<p>Veuillez choisir des options</p>";
}


?>
