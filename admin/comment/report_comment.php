<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../includes/db.php";
$id_comment = htmlspecialchars($_GET["id_comment"]);
$id_recipe = htmlspecialchars($_GET["id_recipe"]);
$name_recipe = htmlspecialchars($_GET["name_recipe"]);

$deleteMessage = $db->prepare(
  "INSERT INTO REPORT_COM (id_user, id_comment) VALUES (:id_user , :id_comment)"
);
$deleteMessage->execute([
  "id_user" => $_SESSION["id"],
  "id_comment" => $id_comment,
]);
header(
  "location: https://topcook.site/recipes/recipe.php?name=$name_recipe&id=$id_recipe&message=Commentaire supprimé avec succés !&type=success"
);
exit();
