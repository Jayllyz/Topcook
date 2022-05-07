<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$idRecipe = $_GET['id'];
$idUser = $_SESSION['id'];

$deleteFavorite = $db->query("DELETE FROM FAVORITE_RECIPE WHERE idUser = " . $idUser . " AND idRecipe = " . $idRecipe);
echo "<p class='mt-3 mb-3 alert alert-success'>La recette a bien été supprimée de vos favoris.</p>";
