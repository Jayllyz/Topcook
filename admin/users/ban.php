<?php
include "../../includes/db.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$id = $_GET["id"];
$pseudo = $_POST["pseudo"];
$pseudoUser = $_GET["pseudo"];

if ($pseudo == $pseudoUser) {
  $del = $db->prepare("UPDATE USER SET rights = -1 WHERE id = :id");
  $del->execute([
    "id" => $id,
  ]);
  header(
    "location: ../admin.php?message=Utilisateur banni avec succès&type=success"
  );
  exit();
} else {
  header(
    'location: ../admin.php?message=Le nom d\'utilisateur saisi est incorrect ! Veuillez réessayer.&type=danger'
  );
  exit();
}

?>
