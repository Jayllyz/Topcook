<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set("Europe/Paris");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";
include "../includes/db.php";

if (isset($_POST["submit"])) {
  if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    header(
      "location: ../inscription.php?message=Email invalide !&valid=invalid&input=email"
    );
    exit();
  } else {
    setcookie("email", $_POST["email"], time() + 3600, "/");
  }
  // Verifier si le pseudo n'est pas déja utiliser

  $req = $db->prepare("SELECT id FROM USER WHERE pseudo = :pseudo");
  $req->execute([
    "pseudo" => $_POST["pseudo"],
  ]);
  // Recupérer la première ligne de résultat
  $reponse = $req->fetch(); // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
  // Si la ligne existe : erreur, le pseudo est déja utilisé
  if ($reponse) {
    header(
      "location: ../inscription.php?message=Ce pseudo est déja utilisé !&valid=invalid&input=pseudo"
    );
    exit();
  } else {
    setcookie("pseudo", $_POST["pseudo"], time() + 3600, "/");
  }
  // Fin vérif pseudo

  // Verif si la date de naissance est saisi

  if (isset($_POST["birth"])) {
    setcookie("birth", $_POST["birth"], time() + 3600, "/");
  }
  if (strlen($_POST["password"]) < 6 || strlen($_POST["password"]) > 15) {
    header(
      "location: ../inscription.php?message=Mot de passe invalide. Il doit etre compris entre 6 et 15 caractères !&valid=invalid&input=mdp"
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
        "location: ../inscription.php?message=Type de fichier incorrect.&valid=invalid&input=fichier"
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

    // Enregistrer le fichier sur le serveur

    // Chemin d'enregistrement
    $path = "../uploads";

    // Vérifier que le dossier uploads existe, sinon le créer
    if (!file_exists($path)) {
      mkdir($path, 0777);
    }

    $filename = $_FILES["image"]["name"];

    // Créer un nom de fichier à partir de la date (timestamp)
    // image-1613985411.ext
    // Attention : deux fichiers uploadés dans la même seconde auront le même nom !!

    // Récupérer l'extension du fichier
    $array = explode(".", $filename);
    $ext = end($array); // extension du fichier

    $filename = "image-" . time() . "." . $ext;

    // Déplacer le fichier vers son emplacement définitif (le dossier uploads)
    $destination = $path . "/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
  } else {
    $image_exist = 0;
  }

  // Verifier si l'email n'est pas déja utiliser

  // Requete SELECT FROM ... WHERE
  $req = $db->prepare("SELECT id FROM USER WHERE email = :email");
  $req->execute([
    "email" => $_POST["email"],
  ]);
  // Recupérer la première ligne de résultat
  $reponse = $req->fetch(); // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
  // Si la ligne existe : erreur, l'email est déja utilisé
  if ($reponse) {
    header(
      "location: ../inscription.php?message=Cet email est déja utilisé !&valid=invalid&input=email"
    );
    exit();
  }
  // Fin vérif email

  if (
    !empty($_POST["pseudo"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["password"]) &&
    !empty($_POST["conf_password"]) &&
    !empty($_POST["birth"])
  ) {
    if ($_POST["password"] == $_POST["conf_password"]) {
      $req = $db->prepare(
        "INSERT INTO USER (pseudo,email,password,date_birth,image,token,creation) VALUES (:pseudo,:email,:password,:date_birth,:image, :token,:creation)"
      );
      $token = uniqid();
      $email = $_POST["email"];
      $pseudo = $_POST["pseudo"];
      $password = $_POST["password"];
      $conf_password = $_POST["conf_password"];
      $birth = $_POST["birth"];
      $creation = date("d-m-Y H:i:s");

      $req->execute([
        "pseudo" => $pseudo,
        "email" => $email,
        "password" => hash("sha512", $password),
        "date_birth" => $birth,
        "image" => isset($filename) ? $filename : "",
        "token" => $token,
        "creation" => $creation,
      ]);
      $subject = "Confirmation de votre inscription";
      $mailMsg = "Validé votre inscription!";
      $msgHTML =
        '<img src="http://164.132.229.157/images/topcook_logo.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
                  <p class="display-2">Bienvenue sur TopCook. Veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription :<br></p>
        <a href="http://164.132.229.157/includes/conf_registration.php?' .
        "token=" .
        $token .
        "&email=" .
        $email .
        '">Confirmation !</a>';
      $destination = "http://164.132.229.157/index.php";
      include "../includes/mailer.php";
    } else {
      header(
        "location: ../inscription.php?message=Les mots de passes ne sont pas identiques !&type=danger"
      );
      exit();
    }
  }
  if ($image_exist == 1) {
    header(
      "location: ../connexion.php?message=Inscription réussi !&type=success"
    );
    exit();
  } else {
    $req = $db->prepare("SELECT id FROM USER WHERE pseudo = :pseudo");
    $req->execute([
      "pseudo" => $_POST["pseudo"],
    ]);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    foreach ($result as $id) {
      header("location: ../avatar/avatar.php?id=" . $id . "");
      exit();
    }
  }
} else {
  header(
    "location: ../inscription.php?message=Les champs ne sont pas tous remplis !&type=danger"
  );
  exit();
}

?>
