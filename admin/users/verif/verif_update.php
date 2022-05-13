<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../../includes/db.php";
$email = $_POST['email'];
$rights = $_POST['rights'];
$pseudo = $_POST['pseudo'];
$id_user = htmlspecialchars($_GET['id']);

if (isset($email) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header(
        "location: ../update.php?message=Email invalide !&type=danger"
    );
    exit();
} else {
    setcookie("email", $email, time() + 3600, "/");
}


if (isset($rights) && !empty($rights) || isset($pseudo) && !empty($pseudo) || isset($email) && !empty($email)) {
    setcookie("rights", $rights, time() + 3600, "/");


    $update = $db->prepare("UPDATE USER SET email = :email, pseudo = :pseudo, rights = :rights WHERE id = :id");
    $update->execute([
        "email" => $email,
        "pseudo" => $pseudo,
        "rights" => $rights,
        "id" => $id_user,
    ]);
    header("location: ../../admin.php?message=Modification effectué !&type=success");
    exit();
}
