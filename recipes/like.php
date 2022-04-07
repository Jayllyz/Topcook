<?php
session_start();
$id = htmlspecialchars($_GET["id"]);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

if (isset($_SESSION["id"])) {
  $req = $db->prepare("UPDATE RECIPE SET votes = votes + 1 WHERE id = :id");
  $req->execute([
    "id" => $id,
  ]);

  header(
    "location: ../allrecipe.php?message=Votre vote a bien été pris en compte !&type=success"
  );
  exit();
}else{
  header(
    "location: ../allrecipe.php?message=Vous devez être connecté pour voter !&type=danger"
  );
  exit();
}
?>
