<?php
session_start();
include "../includes/db.php";
if (isset($_POST["submit"])) {
  $password = $_POST["password"];
  $conf_password = $_POST["confPassword"];
  $email = htmlspecialchars($_GET["email"]);
  $token = htmlspecialchars($_GET["token"]);
  if (strlen($password) < 6 || strlen($password) > 15) {
    header(
      "location: ../includes/change_password.php?message=Mot de passe invalide. Il doit etre compris entre 6 et 15 caractères !&type=danger"
    );
    exit();
  }
  if ($password == $conf_password) {
    $req = $db->prepare('UPDATE USER set token = "" WHERE email = :email');
    $req->execute([
      "email" => $email,
    ]);
    $req = $db->prepare(
      "UPDATE USER SET password = :password WHERE email = :email"
    );
    $req->execute([
      "password" => hash("sha512", $password),
      "email" => $email,
    ]);
    header(
      "location: ../connexion.php?message=Votre mot de passe a bien été réinitialisé !&type=success"
    );
    exit();
  } else {
    header(
      "location: ../includes/change_password.php?message=Les mots de passes ne sont pas identiques !&type=warning&email=$email&token=$token"
    );
    exit();
  }
}
