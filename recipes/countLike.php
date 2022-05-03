<?php
session_start();
$id = htmlspecialchars($_GET['id']);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES WHERE id_recipe = :id_recipe"
);
$selectLike->execute([
    "id_recipe" => $id
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
echo $resultLike;

?>
