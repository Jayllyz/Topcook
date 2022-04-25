<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$idAccessories = htmlspecialchars($_GET['id']);
$idUser = $_SESSION['id'];
$type = htmlspecialchars($_GET['type']);
$type = strtolower($type);

if($type == "----choisir une option de tri----"){
    echo "<p class='alert alert-danger'>Choisisez une option</p>";
}else {
    $updateAvatar = $db->prepare("UPDATE AVATAR SET " . $type . "= :type WHERE idUser = :idUser");
    $updateAvatar->execute([
        'type' => $idAccessories,
        'idUser' => $idUser
    ]);

}


?>
