<?php
session_start();
date_default_timezone_set("Europe/Paris");
$date = date("d/m/Y H:i:s");

include "../includes/db.php";

if (isset($_POST["submit"])) {
  if (isset($_POST["login"]) && !empty($_POST["login"])) {
    setCookie("login", $_POST["login"], time() + 24 * 3600);
  }

  if (
    empty($_POST["login"]) ||
    !filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)
  ) {
    header("location: ../connexion?message=Email invalide !&type=danger");
    exit();
  }

  if (!isset($_POST["password"]) || empty($_POST["password"])) {
    header(
      "location: ../connexion?message=Mot de passe manquant !&type=danger"
    );
    exit();
  }

  $req = $db->prepare(
    "SELECT id, rights,email FROM USER WHERE email = :email AND password = :password"
  );
  $req->execute([
    "email" => $_POST["login"],
    "password" => hash("sha512", $_POST["password"]),
  ]);
  $selectConf = $db->prepare(
    "SELECT confirm_signup FROM USER WHERE email = :email"
  );
  $selectConf->execute([
    "email" => $_POST["login"],
  ]);
  $resultConf = $selectConf->fetch(PDO::FETCH_ASSOC);
  $reponse = $req->fetchAll(PDO::FETCH_ASSOC);
  if ($reponse) {
    foreach ($resultConf as $conf) {
      foreach ($reponse as $select) {
        if ($conf == 0) {
          header(
            "location: ../connexion?message=Vous n'avez pas confirmer votre email, veuillez vérifier votre boite mail et vos spam !&type=danger"
          );
          exit();
        } else {
          if ($select["rights"] != -1) {
            $_SESSION["id"] = $select["id"];
            $_SESSION["rights"] = $select["rights"];
            $_SESSION["email"] = $select["email"];
            setcookie("email", $_POST["login"], time() + 3600);
            $login = $_POST["login"];
            $log_success = fopen("../log/log_success.txt", "a+");
            fputs($log_success, "Connexion reussi le ");
            fputs($log_success, $date);
            fputs($log_success, " par ");
            fputs($log_success, $_SESSION["id"]);
            fputs($log_success, " ($login)");
            fputs($log_success, "\n");
            fclose($log_success);
            header(
              "location: https://topcook.site/?message=Vous êtes connecté&type=success"
            );
            exit();
          } else {
            header("location: https://topcook.site/profile/banned.php");
            exit();
          }
        }
      }
    }
  } else {
    $log_errors = fopen("../log/log_errors.txt", "a+");
    fputs($log_errors, "Tentative de connexion le ");
    fputs($log_errors, $date);
    fputs($log_errors, "\n");
    fclose($log_errors);
    header(
      "location: ../connexion?message=Cet email n'existe pas !&type=danger"
    );
    exit();
  }
}
