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
    "DELETE FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
  );
  $req->execute([
    "id_recipe" => $id_recipe,
    "id_user" => $_SESSION["id"],
  ]);
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Votre vote a bien été retiré !&type=success"
  );
  $date = date("d/m/Y H:i:s");
  $log_dislike = fopen("../log/recipe_dislikes/$name.txt", "a+");
  fputs($log_dislike, $id_recipe . " ");
  fputs($log_dislike, "disliké le ");
  fputs($log_dislike, $date);
  fputs($log_dislike, "par  ");
  fputs($log_dislike, $_SESSION["id"]);
  fputs($log_dislike, "\n");
  fclose($log_dislike);
  exit();
} else {
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous devez être connecté pour voter !&type=danger"
  );
  exit();
}

?>
