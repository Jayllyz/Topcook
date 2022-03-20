<?php
include "../../includes/db.php";
$id = $_GET["id"];
$pseudo = $_POST["pseudo"];
$pseudoUser = $_GET["pseudo"];
if ($pseudo == $pseudoUser) {
  $del = $db->prepare("DELETE FROM USER WHERE id = :id");
  $del->execute([
    "id" => $id,
  ]);
  header(
    "location: ../admin.php?message=Utilisateur supprimé avec succès&type=success"
  );
  exit();
} else {
  header(
    'location: ../admin.php?message=Le nom d\'utilisateur saisi est incorrect ! Veuillez réessayer.&type=danger'
  );
  exit();
}

?>
