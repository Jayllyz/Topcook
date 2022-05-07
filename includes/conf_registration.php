<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "db.php";
$req = $db->prepare("SELECT id, token FROM USER WHERE email = :email");
$req->execute([
  "email" => htmlspecialchars($_GET["email"]),
]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $existToken) {
  $idUser = $existToken['id'];
  if ($existToken != "") {
    $token = htmlspecialchars($_GET["token"]);
    $email = htmlspecialchars($_GET["email"]);
    if (isset($token)) {
      $q = $db->prepare(
        "UPDATE USER SET confirm_signup = 1 WHERE email = :email AND token = :token"
      );
      $q->execute([
        "email" => $email,
        "token" => $token,
      ]);
      $req = $db->prepare('UPDATE USER set token = "" WHERE email = :email');
      $req->execute([
        "email" => $email,
      ]);

      $_SESSION["email"] = $email;
      session_destroy();
      echo "
  <div class='text-center'>
  <div class='alert alert-success' role='alert'>
    <img src='https://topcook.site/images/topcook_logo.svg' class='logo float-left m-2 h-75 me-4' width='95' alt='Logo'>
    <h4 class='alert-heading'><strong>Congratulations !</strong></h4>
    <p>Votre compte a été confirmé ! Vous pouvez retourner sur notre site en cliquant sur ce lien :
    <a href='https://topcook.site' class='text-decoration-none'><em>Home</em></a> pour vous connecter et fermer
    cette page.
    TopCook, vous souhaite la bienvenue !</p>
  </div>
  </div>
  ";
      $createAvatar = $db->prepare("INSERT INTO AVATAR (idUser) VALUES (:idUser)");
      $createAvatar->execute([
        "idUser" => $idUser,
      ]);
    } else {
      session_destroy();
      echo "Email doesn't confirmed !";
    }
  } else {
    header("location: https://topcook.site/?message=Le liens à expiré !&type=danger");
    exit();
  }
}
