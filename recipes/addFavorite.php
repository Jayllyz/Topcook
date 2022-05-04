<?php
session_start();

include '../includes/db.php';
$id_recipe = $_POST['id'];
$selectFavorite = $db->query("SELECT idUser, idRecipe FROM FAVORITE_RECIPE WHERE idUser = " . $_SESSION["id"] . " AND idRecipe = " . $_POST["id"]);
$favorite = $selectFavorite->fetch(PDO::FETCH_ASSOC);
$idUserFavorite = $favorite["idUser"];
$idRecipeFavorite = $favorite["idRecipe"];
if($idUserFavorite == $_SESSION["id"] && $idRecipeFavorite == $_POST["id"]) {

    $deleteFavorite = $db->query("DELETE FROM FAVORITE_RECIPE WHERE idUser = ".$_SESSION['id']." AND idRecipe = ".$id_recipe);
    echo "<p class='mt-3 mb-3 alert alert-success'>La recette a bien été supprimée de vos favoris.</p>";

}else{
    $addFavorite = $db->prepare("INSERT INTO FAVORITE_RECIPE (idUser, idRecipe) VALUES (:idUser, :idRecipe)");
    $addFavorite->execute([
        'idUser' => $_SESSION['id'],
        'idRecipe' => $id_recipe
    ]);
    $result = $addFavorite->fetchAll(PDO::FETCH_ASSOC);
}

$query = $db->prepare(
    "SELECT id, name, images, description, time_prep, time_cooking, nb_persons, type, id_user FROM RECIPE WHERE id = :id"
);
$query->execute([
    "id" => htmlspecialchars($_GET["id"]),
]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $select) {
    $id = $select['id'];
    echo "la recette a bien été ajoutée à vos favoris";

}
?>