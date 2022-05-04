<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$commentaire = $_POST['comment'];
$submit = $_POST['submit'];
$id_recipe = htmlspecialchars($_GET['id_recipe']);
$name = htmlspecialchars($_GET['name']);
if(isset($_SESSION['id'])) {



    $addComment = $db->prepare("INSERT INTO COMMENTAIRE (message,id_recipe,id_user,date_send) VALUES (:message,:id_recipe,:id_user,:date_send)");
    $addComment->execute([
        'message' => $commentaire,
        'id_recipe' => $id_recipe,
        'id_user' => $_SESSION['id'],
        'date_send' => date("d-m-Y H:i:s")
    ]);
    header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Commentaire ajouté !&type=success");
    exit();
}else{
    header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous devez être connecté pour ajouter un commentaire&type=danger");
    exit();
}

?>