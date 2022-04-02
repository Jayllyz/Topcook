<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

if (isset($_POST["submit"])) {
    if(empty($_POST["nom"]) || strlen($_POST["nom"]) < 2 || strlen($_POST["nom"]) > 25) {
        header("location: ../recettes.php?message=Nom de recette invalide !&valid=invalid&input=nom");
        exit();
    }
    if(empty($_POST["description"]) ) {
      header("location: ../recettes.php?message=Description trop longue !&valid=invalid&input=description");
      exit();
  }
    if(empty($_POST["time_prep"]) ) {
        header("location: ../recettes.php?message=Temps de préparation invalide !&valid=invalid&input=time_prep");
        exit();
    }
    if(empty($_POST["time_cook"]) ) {
        header("location: ../recettes.php?message=Temps de cuisson invalide !&valid=invalid&input=time_cook");
        exit();
    }
    if(empty($_POST["number"]) ||$_POST["number"] == 0) {
        header("location: ../recettes.php?message=Nombre de personne invalide!&valid=invalid&input=number");
        exit();
    }
    if(empty($_POST["type"]) || strlen($_POST["type"]) < 2 || strlen($_POST["type"]) > 15) {
        header("location: ../recettes.php?message=Type de recette invalide !&valid=invalid&input=type");
        exit();
    }

    $image_exist = 1;
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
      // Vérifier le type de fichier
      $acceptable = ["image/jpeg", "image/png"];
  
      if (!in_array($_FILES["image"]["type"], $acceptable)) {
        // Rediriger vers inscription.php avec un message d'erreur
        header(
          "location: ../recettes.php?message=Type de fichier incorrect.&valid=invalid&input=image"
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
    } else {
      $image_exist = 0;
      header("location: ../recettes.php?message=Veuillez ajouter une image !&valid=invalid&input=image");
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
      if($image_exist == 1) {
        header("location: ../recettes.php?message=Recette ajoutée avec succès !&type=success");
        exit();
      }
      
} else {
    header(
      "location: ../recettes.php?message=Les champs ne sont pas tous remplis !&type=danger"
    );
    exit();
}
?>