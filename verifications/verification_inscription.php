<?php
session_start();
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


  $req = $db->prepare("SELECT id FROM USER WHERE pseudo = :pseudo");
  $req->execute([
    "pseudo" => $_POST["pseudo"],
  ]);

  $reponse = $req->fetch();

  if ($reponse) {
    header(
      "location: ../inscription.php?message=Ce pseudo est déja utilisé !&valid=invalid&input=pseudo"
    );
    exit();
  } else {
    setcookie("pseudo", $_POST["pseudo"], time() + 3600, "/");
  }

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

    $acceptable = ["image/jpeg", "image/png"];

    if (!in_array($_FILES["image"]["type"], $acceptable)) {

      header(
        "location: ../inscription.php?message=Type de fichier incorrect.&valid=invalid&input=fichier"
      );
      exit();
    }


    $maxSize = 2 * 1024 * 1024; //2Mo

    if ($_FILES["image"]["size"] > $maxSize) {

      header(
        "location: ../inscription.php?message=Ce fichier est trop lourd.&valid=invalid&input=fichier"
      );
      exit();
    }


    $path = "../uploads";


    if (!file_exists($path)) {
      mkdir($path, 0777);
    }

    $filename = $_FILES["image"]["name"];

    $array = explode(".", $filename);
    $ext = end($array);

    $filename = "image-" . time() . "." . $ext;

    $destination = $path . "/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
    include '../includes/resolution.php';
  } else {
    $image_exist = 0;
  }

  $req = $db->prepare("SELECT id FROM USER WHERE email = :email");
  $req->execute([
    "email" => $_POST["email"],
  ]);

  $reponse = $req->fetch();

  if ($reponse) {
    header(
      "location: ../inscription.php?message=Cet email est déja utilisé !&valid=invalid&input=email"
    );
    exit();
  }


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
        '<img src="https://topcook.site/images/topcook_logo.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
                  <p class="display-2">Bienvenue sur TopCook. Veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription :<br></p>
        <a href="https://topcook.site/includes/conf_registration.php?' .
        "token=" .
        $token .
        "&email=" .
        $email .
        '">Confirmation !</a>';
      $destination = "https://topcook.site/";
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
