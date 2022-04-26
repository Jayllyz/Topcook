<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$type = htmlspecialchars($_GET['type']);
$type = strtolower($type);

$delElement = $db->query("UPDATE AVATAR SET $type = NULL WHERE idUser = ".$_SESSION['id']);


?>
