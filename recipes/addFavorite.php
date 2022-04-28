<?php
session_start();

include '../includes/db.php';
$id_recipe = $_GET['id'];

$addFavorite = $db->prepare("INSERT INTO FAVORITE_RECIPE (idUser, idRecipe) VALUES (:idUser, :idRecipe)");
$addFavorite->execute([
    'idUser' => $_SESSION['id'],
    'idRecipe' => $id_recipe
]);
$result = $addFavorite->fetchAll(PDO::FETCH_ASSOC);
echo "<p class='mt-3 mb-3 alert alert-success'>La recette a bien été ajoutée à vos favoris</p>";


?>