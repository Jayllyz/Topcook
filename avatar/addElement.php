<?php
session_start();
include "../includes/db.php";
if (!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}
$idAccessories = htmlspecialchars($_GET['id']);
$idUser = $_SESSION['id'];
$type = htmlspecialchars($_GET['type']);
$type = strtolower($type);

if ($type == "Choisir un type d'accessoire") {
    echo "<p class='alert alert-danger'>Choisisez une option</p>";
} else {
    $updateAvatar = $db->prepare("UPDATE AVATAR SET " . $type . "= :type WHERE idUser = :idUser");
    $updateAvatar->execute([
        'type' => $idAccessories,
        'idUser' => $idUser
    ]);
}
