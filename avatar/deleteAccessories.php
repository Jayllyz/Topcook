<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}
$type = htmlspecialchars($_GET['type']);
$type = strtolower($type);

$delElement = $db->query("UPDATE AVATAR SET $type = NULL WHERE idUser = " . $_SESSION['id']);
