<?php
session_start();
include '../includes/db.php';
$idUser = $_SESSION['id'];
$nameCol = htmlspecialchars($_GET['nameCol']);
$color = htmlspecialchars($_GET['color']);

$updateColor = $db->query("UPDATE AVATAR SET $nameCol = '$color' WHERE idUser = ". $idUser);

?>
