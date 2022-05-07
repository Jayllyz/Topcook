<?php
session_start();
include "../includes/db.php";
include "../includes/functions.php";
$commentaire = $_POST['comment'];
$submit = $_POST['submit'];
$id_recipe = htmlspecialchars($_GET['id_recipe']);
$name = htmlspecialchars($_GET['name']);
if (isset($_SESSION['id'])) {

    $addComment = $db->prepare("INSERT INTO COMMENTAIRE (message,id_recipe,id_user,date_send) VALUES (:message,:id_recipe,:id_user,:date_send)");
    $addComment->execute([
        'message' => $commentaire,
        'id_recipe' => $id_recipe,
        'id_user' => $_SESSION['id'],
        'date_send' => date("d-m-Y H:i:s")
    ]);
    $count = banword("https://topcook.site/banlist.txt", $commentaire, $db, 1);
    if ($count > 0) {
        header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Commentaire ajouté mais avec $count bouteilles!&type=warning");
        exit();
    }
    header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Commentaire ajouté !&type=success");
    exit();
} else {
    header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous devez être connecté pour ajouter un commentaire&type=danger");
    exit();
}
