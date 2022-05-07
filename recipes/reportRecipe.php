<?php
session_start();
$id_recipe = htmlspecialchars($_GET["id"]);
$name = htmlspecialchars($_GET["name"]);
include "../includes/db.php";

if (isset($_SESSION["id"])) {
  $req = $db->prepare(
    "INSERT INTO REPORT_RECIPE (id_user, id_recipe )VALUES( :id_user , :id_recipe)"
  );
  $req->execute([
    "id_recipe" => $id_recipe,
    "id_user" => $_SESSION["id"],
  ]);
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Votre signalement a bien été pris en compte !&type=success"
  );
  $date = date("d/m/Y H:i:s");
  $report_log = fopen("../log/recipe_report/$name.txt", "a+");
  fputs($report_log, $id_recipe . " ");
  fputs($report_log, "signalé le ");
  fputs($report_log, $date);
  fputs($report_log, "par  ");
  fputs($report_log, $_SESSION["id"]);
  fputs($report_log, "\n");
  fclose($report_log);
  exit();
} else {
  header(
    "location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Vous devez être connecté pour signaler !&type=danger"
  );
  exit();
}
