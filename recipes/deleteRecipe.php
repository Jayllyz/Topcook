<?php
session_start();
$id_recipe = htmlspecialchars($_GET["id"]);
$id_user = htmlspecialchars($_GET["id_user"]);
$name = htmlspecialchars($_GET["name"]);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

if (isset($_SESSION["id"]) && ($_SESSION["id"] == $id_user || $_SESSION["rights"] == 1)) {
  $selectCom = $db->query("SELECT id FROM COMMENTAIRE WHERE id_recipe = ". $id_recipe);
    $selectCom = $selectCom->fetchAll(PDO::FETCH_ASSOC);
    foreach ($selectCom as $com) {
      $deleteReport = $db->prepare("DELETE FROM REPORT_COM WHERE id_comment = :id_comment ");
      $deleteReport->execute([
        "id_comment" => $com["id"],
      ]);
      $deleteCom = $db->prepare("DELETE FROM COMMENTAIRE WHERE id_recipe = :id_recipe");
        $deleteCom->execute([
            "id_recipe" => $id_recipe,
        ]);
    }
    $selectIngredients = $db->query("SELECT id FROM INGREDIENT WHERE id_recipe = ". $id_recipe);
    $selectIngredients = count($selectIngredients->fetchAll(PDO::FETCH_ASSOC));
    if($selectIngredients > 0) {
        $deleteIngredients = $db->prepare("DELETE FROM INGREDIENT WHERE id_recipe = :id_recipe");
        $deleteIngredients->execute([
            "id_recipe" => $id_recipe,
        ]);
    }
    $selectFavorite = $db->query("SELECT idUser FROM FAVORITE_RECIPE WHERE idRecipe = ". $id_recipe);
    $selectFavorite = count($selectFavorite->fetchAll(PDO::FETCH_ASSOC));
    if($selectFavorite > 0) {
        $deleteFavorite = $db->prepare("DELETE FROM FAVORITE_RECIPE WHERE idRecipe = :idRecipe");
        $deleteFavorite->execute([
            "idRecipe" => $id_recipe,
        ]);
    }
    $selectLike = $db->query("SELECT id_user FROM LIKES WHERE id_recipe = ". $id_recipe);
    $selectLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
    if($selectLike > 0) {
        $deleteLike = $db->prepare("DELETE FROM LIKES WHERE id_recipe = :id_recipe");
        $deleteLike->execute([
            "id_recipe" => $id_recipe,
        ]);
    }
  $req = $db->prepare("DELETE FROM STEPS WHERE  id_recipe = :id_recipe");
  $req->execute([
    "id_recipe" => $id_recipe,
  ]);
  $selectReportRecipe = $db->query("SELECT id FROM REPORT_RECIPE WHERE id_recipe = ". $id_recipe);
    $selectReportRecipe = count($selectReportRecipe->fetchAll(PDO::FETCH_ASSOC));
    if($selectReportRecipe > 0) {
        $deleteReportRecipe = $db->prepare("DELETE FROM REPORT_RECIPE WHERE id_recipe = :id_recipe");
        $deleteReportRecipe->execute([
            "id_recipe" => $id_recipe,
        ]);
    }


  $req = $db->prepare(
    "DELETE FROM RECIPE WHERE id = :id_recipe"
  );
  $req->execute([
    "id_recipe" => $id_recipe,
  ]);
  $date = date("d/m/Y H:i:s");
  $log_dislike = fopen("../log/recipe_logs/recipe.txt", "a+");
  fputs($log_dislike, $name . " ");
  fputs($log_dislike, "supprimé le ");
  fputs($log_dislike, $date);
  fputs($log_dislike, "par ");
  fputs($log_dislike, $_SESSION["id"]);
  fputs($log_dislike, "\n");
  fclose($log_dislike);
  $delete_log_recipe = "../log/recipe_logs/$name.txt";
  unlink($delete_log_recipe);

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
