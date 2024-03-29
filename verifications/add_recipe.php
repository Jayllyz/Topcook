<?php
session_start();
include "../includes/db.php";

if (isset($_POST["submit"])) {
  if (
    empty($_POST["nom"]) ||
    strlen($_POST["nom"]) < 2 ||
    strlen($_POST["nom"]) > 25
  ) {
    header(
      "location: ../recettes.php?message=Nom de recette invalide !&type=danger"
    );
    exit();
  }
  if (
    empty($_POST["description"]) ||
    strlen($_POST["description"]) < 2 ||
    strlen($_POST["description"]) > 70
  ) {
    header(
      "location: ../recettes.php?message=Description invalide!&type=danger"
    );
    exit();
  }
  if (empty($_POST["time_prep"])) {
    header(
      "location: ../recettes.php?message=Temps de préparation invalide !&type=danger"
    );
    exit();
  }
  if (empty($_POST["time_cook"]) && $_POST["time_cook"] != 0) {
    header(
      "location: ../recettes.php?message=Temps de cuisson invalide !&type=danger"
    );
    exit();
  }
  if (empty($_POST["number"]) || $_POST["number"] == 0) {
    header(
      "location: ../recettes.php?message=Nombre de personne invalide!&type=danger"
    );
    exit();
  }
  if (
    empty($_POST["type"]) ||
    ($_POST["type"] != "entrée" &&
      $_POST["type"] != "plat" &&
      $_POST["type"] != "dessert")
  ) {
    header(
      "location: ../recettes.php?message=Type de recette invalide !&type=danger"
    );
    exit();
  }

  $image_exist = 1;
  if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
    // Vérifier le type de fichier
    $acceptable = ["image/jpeg", "image/png"];

    if (!in_array($_FILES["image"]["type"], $acceptable)) {
      // Rediriger vers inscription.php avec un message d'erreur
      header(
        "location: ../recettes.php?message=Type de fichier incorrect.&type=danger"
      );
      exit();
    }

    // Vérifier le poids du fichier
    $maxSize = 2 * 1024 * 1024; //2Mo

    if ($_FILES["image"]["size"] > $maxSize) {
      // Rediriger vers inscription.php avec un message d'erreur
      header(
        "location: ../inscription.php?message=Ce fichier est trop lourd.&valid=invalid&input=fichier"
      );
      exit();
    }

    $path = "../uploads/recipe";

    if (!file_exists($path)) {
      mkdir($path, 0777);
    }

    $filename = $_FILES["image"]["name"];

    $array = explode(".", $filename);
    $ext = end($array); // extension du fichier

    $filename = "recipe-" . time() . "." . $ext;

    $destination = $path . "/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
    include "../includes/resolution.php";
  } else {
    $image_exist = 0;
    header(
      "location: ../recettes.php?message=Veuillez ajouter une image !&valid=invalid&input=image"
    );
    exit();
  }

  $req = $db->prepare(
    "INSERT INTO RECIPE (name,description,time_prep,time_cooking,nb_persons,images,type,id_user) VALUES (:name,:description,:time_prep,:time_cooking,:nb_persons,:image, :type,:id_user)"
  );
  $name = $_POST["nom"];
  $description = $_POST["description"];
  $time_prep = $_POST["time_prep"];
  $time_cooking = $_POST["time_cook"];
  $nb_persons = $_POST["number"];
  $type = $_POST["type"];
  $id_user = $_SESSION["id"];

  $req->execute([
    "name" => $name,
    "time_prep" => $time_prep,
    "description" => $description,
    "time_cooking" => $time_cooking,
    "nb_persons" => $nb_persons,
    "image" => isset($filename) ? $filename : "",
    "type" => $type,
    "id_user" => $id_user,
  ]);

  $selectRecipe = $db->prepare("SELECT id FROM RECIPE WHERE name = :name");
  $selectRecipe->execute([
    "name" => $name,
  ]);
  $selectIdRecipe = $selectRecipe->fetch(PDO::FETCH_ASSOC);
  foreach ($selectIdRecipe as $idRecipe) {
    $id_recipe = $idRecipe;
  }
  $nbSteps = count($_POST["steps"]);
  for ($i = 0; $i < $nbSteps; $i++) {
    $steps[$i] = $_POST["steps"][$i];

    $req = $db->prepare(
      "INSERT INTO STEPS (id_recipe,details,orders) VALUES (:id_recipe,:details,:orders)"
    );
    $req->execute([
      "id_recipe" => $id_recipe,
      "details" => $steps[$i],
      "orders" => $i,
    ]);
  }

  if ($image_exist == 1) {
    $date = date("d/m/Y H:i:s");
    $log_recipe = fopen("../log/recipe_logs/recipe.txt", "a+");
    fputs($log_recipe, $name . " ");
    fputs($log_recipe, "ajouté le ");
    fputs($log_recipe, $date);
    fputs($log_recipe, "par ");
    fputs($log_recipe, $_SESSION["id"]);
    fputs($log_recipe, "\n");
    fclose($log_recipe);

    header(
      "location: https://topcook.site/recipes/ingredients.php?message=Recette ajoutée avec succès !&type=success&name=$name&id=$id_recipe"
    );
    exit();
  }
} else {
  header(
    "location: ../recipes/recipe.php?message=Les champs ne sont pas tous remplis !&type=danger"
  );
  exit();
}
