<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../includes/db.php";
$req = $db->prepare("SELECT token FROM USER WHERE email = :email");
$req->execute([
  "email" => htmlspecialchars($_GET["email"]),
]);
$result = $req->fetch(PDO::FETCH_ASSOC);
if (!$result) {
  $token = htmlspecialchars($_GET["token"]);
  $email = htmlspecialchars($_GET["email"]);
  $id = htmlspecialchars($_GET["id"]);
  $updateEmail = $db->prepare(
    "UPDATE USER SET email = :email, token = '', confirm_signup = 1 WHERE id = :id"
  );
  $updateEmail->execute([
    "email" => $email,
    "id" => $id,
  ]);
  header(
    "location: ../profile.php?id=$id&message=Vos informations ont bien été enregistré !&type=success"
  );
  exit();
} else {
  header(
    "location: http://164.132.229.157/index.php?message=Le liens à expiré !&type=danger"
  );
  exit();
}
?>
