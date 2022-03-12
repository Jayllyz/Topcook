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
    <img src='http://164.132.229.157/images/topcook_logo.svg' class='logo float-left m-2 h-75 me-4' width='95' alt='Logo'>
    <h4 class='alert-heading'><strong>Congratulations !</strong></h4>
    <p>Votre compte a été confirmé ! Vous pouvez retourner sur notre site en cliquant sur ce lien :
    <a href='http://164.132.229.157/index.php' class='text-decoration-none'><em>Home</em></a> pour vous connecter et fermer
    cette page.
    TopCook, vous souhaite la bienvenue !</p>
  </div>
  </div>
  ";
} else {
  session_destroy();
  echo "Email doesn't confirmed !";
}

?>
