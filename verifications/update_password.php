<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";
include "../includes/db.php";
$email = $_POST["email"];
$token = uniqid();
$req = $db->prepare("UPDATE USER SET token = :token WHERE email = :email");
$req->execute([
  "token" => $token,
  "email" => $email,
]);
$req = $db->prepare("SELECT email FROM USER WHERE email = :email");
$req->execute([
  "email" => $email,
]);

$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result) {
  $subject = "Réinitialisation du mot de passe";
  $mailMsg = "Modifier votre mot de passe";
  $msgHTML =
    '<img src="https://topcook.site/images/topcook_logo.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
    <p class="display-2">Pour réinitialiser votre mot de passe, veuillez <a href="https://topcook.site/includes/change_password.php?email=' .
    $email .
    "&token=" .
    $token .
    '">cliquez ici</a></p>';
  $destination = "https://topcook.site/";
  include "../includes/mailer.php";
} else {
  header(
    'location: ../lost_password.php?message=Cet email n\'existe pas !&type=danger'
  );
  exit();
}
