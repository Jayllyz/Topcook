<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "../../PHPMailer/src/Exception.php";
require "../../PHPMailer/src/PHPMailer.php";
require "../../PHPMailer/src/SMTP.php";
include "../../includes/db.php";
$id = $_SESSION["id"];
$selectAll = $db->prepare(
  "SELECT pseudo,email,image,rights FROM USER WHERE id = :id"
);
$selectAll->execute([
  "id" => $id,
]);
$result = $selectAll->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $information) {
  if (isset($_POST["submit"])) {
    // Si un pseudo a été envoyer

    if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
      $pseudo = $_POST["pseudo"];
      if ($pseudo == $information["pseudo"]) {
        header(
          "location: form_update.php?id=$id&message=Vous avez déja ce pseudo ! Veuillez en choisir un autre !&type=warning"
        );
        exit();
      } else {
        $updatePseudo = $db->prepare(
          "UPDATE USER SET pseudo = :pseudo WHERE id = :id"
        );
        $updatePseudo->execute([
          "pseudo" => $pseudo,
          "id" => $id,
        ]);
      }
    }

    // Si un mot de passe a été envoyer

    if (
      isset($_POST["password"]) &&
      !empty($_POST["password"]) &&
      isset($_POST["password_confirm"]) &&
      !empty($_POST["password_confirm"])
    ) {
      $password = $_POST["password"];
      $confPassword = $_POST["password_confirm"];
      if (strlen($password) >= 6 && strlen($password) <= 15) {
        if ($password == $confPassword) {
          $updatePassword = $db->prepare(
            "UPDATE USER SET password = :password WHERE id = :id"
          );
          $updatePassword->execute([
            "password" => hash("sha512", $password),
            "id" => $id,
          ]);
        } else {
          header(
            "location: form_update.php?id=$id&message=Vos mot de passes ne sont pas identiques !&type=danger"
          );
          exit();
        }
      } else {
        header(
          "location: form_update.php?id=$id&message=Votre mot de passe dois etre compris entre 6 et 15 caractères !&type=danger"
        );
        exit();
      }
    }
    // Si une image a été envoyer

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
      // Vérifier le type de fichier
      $acceptable = ["image/jpeg", "image/png"];

      if (!in_array($_FILES["image"]["type"], $acceptable)) {
        // Rediriger vers inscription.php avec un message d'erreur
        header(
          "location: form_update.php?id=$id&message=Type de fichier incorrect.&type=danger"
        );
        exit();
      }

      // Vérifier le poids du fichier
      $maxSize = 2 * 1024 * 1024; //2Mo

      if ($_FILES["image"]["size"] > $maxSize) {
        // Rediriger vers inscription.php avec un message d'erreur
        header(
          "location: form_update.php?id=$id&message=Ce fichier est trop lourd.&type=danger"
        );
        exit();
      }

      // Enregistrer le fichier sur le serveur

      // Chemin d'enregistrement
      $path = "../../uploads";

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
      $destination_image = $path . "/" . $filename;
      move_uploaded_file($_FILES["image"]["tmp_name"], $destination_image);
      $delCurrentImage = $db->prepare(
        'UPDATE USER SET image = "" WHERE id = :id'
      );
      $delCurrentImage->execute([
        "id" => $id,
      ]);

      $updateImage = $db->prepare(
        "UPDATE USER SET image = :image WHERE id = :id"
      );
      $updateImage->execute([
        "image" => $filename,
        "id" => $id,
      ]);
    }

    // Si une email à été envoyer

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
      $email = $_POST["email"];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header(
          "location: form_update.php?id=$id&message=Email invalide !&type=danger"
        );
        exit();
      } elseif ($email == $information["email"]) {
        header(
          "location: form_update.php?id=$id&message=Vous avez déja cette email !&type=warning"
        );
        exit();
      } else {
        $token = uniqid();
        $insertToken = $db->prepare("UPDATE USER SET token = :token");
        $insertToken->execute([
          "token" => $token,
        ]);
        $updateConfirm = $db->prepare(
          "UPDATE USER SET confirm_signup = 0 WHERE id = :id"
        );
        $updateConfirm->execute([
          "id" => $id,
        ]);
        $subject = "Confirmation de votre email";
        $mailMsg = "Valider votre email !";
        $msgHTML =
          '<img src="http://164.132.229.157/images/topcook_logo.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
                  <p class="display-2">Bonjour,<br>Vous avez demander à modifier votre email, nous avons bien pris en compte votre demande. Merci de cliquer sur le liens ci-dessous afin de valider votre email:<br></p>
        <a href="http://164.132.229.157/profile/update/verif_new_email.php?' .
          "token=" .
          $token .
          "&email=" .
          $email .
          "&id=" .
          $id .
          '">Confirmation !</a><br>Cordialement,<br>L\'équipe TopCook';
        $destination = "http://164.132.229.157/profile/update/form_update.php";
        include "../../includes/mailer.php";
      }
    }
    header(
      "Location: ../profile.php?id=$id&message=Vos informations ont bien été enregistré !&type=success"
    );
    exit();
  }
}
?>
