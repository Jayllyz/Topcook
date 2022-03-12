<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "db.php";
$token = $_GET["token"];
$email = $_GET["email"];
if (isset($_GET["token"])) {
  $q = $db->prepare(
    "UPDATE USER SET confirm_signup = 1 WHERE email = :email AND token = :token"
  );
  $q->execute([
    "email" => $email,
    "token" => $token,
  ]);

  $_SESSION["email"] = $email;
  session_destroy();
  echo "
  <div class='text-center'>
  <div class='alert alert-success' role='alert'>
    <img src='https://dna-esgi.fr/images/LogoProjet.svg' class='logo float-left m-2 h-75 me-4' width='95' alt='Logo'>
    <h4 class='alert-heading'><strong>Congratulations !</strong></h4>
    <p>Your account has been confirmed! You can return to our site by clicking on this link:
    <a href='https://dna-esgi.fr/index.php' class='text-decoration-none'><em>Home</em></a> to login and close
    this page.
    On behalf of the entire DNA team, we welcome you!</p>
  </div>
  </div>
  ";
} else {
  session_destroy();
  echo "Email doesn't confirmed !";
}

?>
