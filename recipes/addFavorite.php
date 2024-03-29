<?php
session_start();

include '../includes/db.php';
$id_recipe = $_POST['id'];
$selectFavorite = $db->query("SELECT idUser, idRecipe FROM FAVORITE_RECIPE WHERE idUser = " . $_SESSION["id"] . " AND idRecipe = " . $_POST["id"]);
$favorite = $selectFavorite->fetch(PDO::FETCH_ASSOC);
$idUserFavorite = isset($favorite["idUser"]) ? $favorite["idUser"] : null;
$idRecipeFavorite = isset($favorite["idRecipe"]) ? $favorite["idRecipe"] : null;
if ($idUserFavorite == $_SESSION["id"] && $idRecipeFavorite == $_POST["id"]) {

    $deleteFavorite = $db->query("DELETE FROM FAVORITE_RECIPE WHERE idUser = " . $_SESSION['id'] . " AND idRecipe = " . $id_recipe);
    echo "<button class='btn mb-3' id='add_favorite' onclick='addFavorite($id_recipe)'>Ajouter aux favoris</button>";
} else {
    $addFavorite = $db->prepare("INSERT INTO FAVORITE_RECIPE (idUser, idRecipe) VALUES (:idUser, :idRecipe)");
    $addFavorite->execute([
        'idUser' => $_SESSION['id'],
        'idRecipe' => $id_recipe
    ]);
    $result = $addFavorite->fetchAll(PDO::FETCH_ASSOC);
    echo "<button class='btn mb-3 btn-ban' id='add_favorite' onclick='addFavorite($id_recipe)'>Retirer des favoris</button>";
}
