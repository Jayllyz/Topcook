<?php
session_start();
$id = htmlspecialchars($_GET['id']);
include '../includes/db.php';
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES WHERE id_recipe = :id_recipe"
);
$selectLike->execute([
    "id_recipe" => $id
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
echo $resultLike;
