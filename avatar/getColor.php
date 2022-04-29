<?php
session_start();
include "../includes/db.php";

$sql = "SELECT colorHair FROM AVATAR WHERE idUser = " . $_SESSION["id"];
$sql = $db->query($sql);
$result = $sql->fetch(PDO::FETCH_ASSOC);
$colorHair = $result["colorHair"];
echo $colorHair;
