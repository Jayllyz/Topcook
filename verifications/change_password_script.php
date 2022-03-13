<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
if (isset($_POST["submit"])) {
  $password = $_POST["password"];
  $conf_password = $_POST["confPassword"];

  if (strlen($_POST["password"]) < 6 || strlen($_POST["password"]) > 15) {
    header(
      "location: ../includes/change_password.php?message=Mot de passe invalide. Il doit etre compris entre 6 et 15 caractères !&type=danger"
    );
    exit();
  }
  if ($password == $conf_password) {
    $req = $db->prepare(
      "UPDATE USER SET password = :password WHERE email = :email"
    );
    $req->execute([
      "password" => hash("sha512", $password),
      "email" => $_GET["email"],
    ]);
    header(
      "location: ../connexion.php?message=Votre mot de passe a bien été réinitialisé !&type=success"
    );
    exit();
  }
}
?>
