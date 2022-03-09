<?php
include "includes/db.php";
$email = $_POST["email"];
$pseudo = $_POST["pseudo"];
$password = $_POST["password"];
$conf_password = $_POST["conf_password"];
$birth = $_POST["birth"];

if (
  isset($email) &&
  isset($pseudo) &&
  isset($password) &&
  isset($conf_password) &&
  !empty($email) &&
  !empty($pseudo) &&
  !empty($password) &&
  !empty($conf_password)
) {
  $req = $db->prepare(
    "INSERT INTO user (pseudo,email,password,date_birth) VALUES (:pseudo,:password,:date_birth)"
  );
  $req->execute([
    "pseudo" => $pseudo,
    "email" => $email,
    "password" => $password,
    "date_birth" => $birth,
  ]);
}
?>
