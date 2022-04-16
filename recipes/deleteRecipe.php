<?php
session_start();
$id_recipe = htmlspecialchars($_GET["id"]);
$id_user = htmlspecialchars($_GET["id_user"]);
$name = htmlspecialchars($_GET["name"]);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] == $id_user) {
  $req = $db->prepare("DELETE FROM STEPS WHERE  id_recipe = :id_recipe");
  $req->execute([
    "id_recipe" => $id_recipe,
  ]);

  $req = $db->prepare(
    "DELETE FROM RECIPE WHERE id_user = :id_user AND id = :id_recipe"
  );
  $req->execute([
    "id_recipe" => $id_recipe,
    "id_user" => $_SESSION["id"],
  ]);
  $date = date("d/m/Y H:i:s");
  $log_dislike = fopen("../log/recipe_logs/$name.txt", "a+");
  fputs($log_dislike, $name . " ");
  fputs($log_dislike, "supprimé le ");
  fputs($log_dislike, $date);
  fputs($log_dislike, "par ");
  fputs($log_dislike, $_SESSION["id"]);
  fputs($log_dislike, "\n");
  fclose($log_dislike);
  $delete_recipelog = fopen("../log/recipe_logs/$name.txt", "w+");
  unlink($delete_recipelog);

  header(
    "location: https://topcook.site/toutes-nos-recettes?message=Recette supprimée !&type=success"
  );
  exit();
} else {
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous ne pouvez pas supprimé cette recette !&type=danger"
  );
  exit();
}
