<?php
session_start();
$id_recipe = htmlspecialchars($_GET["id"]);
$name = htmlspecialchars($_GET["name"]);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

if (isset($_SESSION["id"])) {
  $req = $db->prepare(
    "INSERT INTO LIKES (votes, id_recipe, id_user )VALUES( :votes , :id_recipe , :id_user)"
  );
  $req->execute([
    "votes" => 1,
    "id_recipe" => $id_recipe,
    "id_user" => $_SESSION["id"],
  ]);

  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Votre vote a bien été pris en compte !&type=success"
  );
  exit();
} else {
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous devez être connecté pour voter !&type=danger"
  );
  exit();
}
?>
