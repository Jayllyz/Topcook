<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$commentaire = $_POST['comment'];
$submit = $_POST['submit'];
$id_recipe = htmlspecialchars($_GET['id_recipe']);


$addComment = $db->prepare("INSERT INTO COMMENTAIRE (message,id_recipe,id_user) VALUES (:message,:id_recipe,:id_user)");
$addComment->execute([
    'message' => $commentaire,
    'id_recipe' => $id_recipe,
    'id_user' => $_SESSION['id']
]);
header("Location: ../allrecipe.php?message=Commetaire ajouté !&type=success");
exit();

?>