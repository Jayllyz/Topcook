<?php
include "../../includes/db.php";
$id = $_GET["id"];
$del = $db->prepare("DELETE FROM USER WHERE id = :id");
$del->execute([
  "id" => $id,
]);
header(
  "location: ../admin.php?message=Utilisateur supprimé avec succès&type=success"
);
exit();
?>
