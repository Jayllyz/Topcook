<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include "../includes/db.php";

if (isset($_POST["submit"])) {
  if (isset($_POST["login"]) && !empty($_POST["login"])) {
    setCookie("login", $_POST["login"], time() + 24 * 3600);
  }

  if (
    empty($_POST["email"]) ||
    !filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)
  ) {
    header("location: ../connexion.php?message=Email invalide !&type=danger");
    exit();
  }

  if (!isset($_POST["password"]) || empty($_POST["password"])) {
    header(
      "location: ../connexion.php?message=Mot de passe manquant !&type=danger"
    );
    exit();
  }

  $req = $db->prepare(
    "SELECT id FROM USER WHERE email = :email AND password = :password"
  );
  $req->execute([
    "email" => $_POST["login"],
    "password" => hash("sha512", $_POST["password"]),
  ]);
  $reponse = $req->fetch();
  if ($reponse) {
    $_SESSION["id"] = $reponse["id"];
    header("location: ../index.php?type=success");
    exit();
  } else {
    header(
      "location: ../connexion.php?message=Email ou mot de passe incorrect !&type=danger"
    );
    exit();
  }
}

?>
