<?php
session_start();
$id = htmlspecialchars($_GET['id']);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES_CONTEST WHERE id_proposal = :id_proposal"
);
$selectLike->execute([
    "id_proposal" => $id
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));

echo $resultLike;
