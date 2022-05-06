<?php
session_start();
$id = htmlspecialchars($_GET['id']);
$id_proposal = htmlspecialchars($_GET['id_prop']);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES_CONTEST WHERE id_contest = :id_contest"
);
$selectLike->execute([
    "id_contest" => $id
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));

echo $resultLike;
