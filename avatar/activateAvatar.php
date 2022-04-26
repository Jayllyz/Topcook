<?php
session_start();
include "../includes/db.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$sql = $db->prepare("SELECT avatar FROM USER WHERE id = :id");
$sql->execute([
    'id' => $_SESSION['id']
]);
$selectResult = $sql->fetch(PDO::FETCH_ASSOC);
if ($selectResult['avatar'] === "0") {
  $update = $db->query(
    "UPDATE USER SET avatar = '1' WHERE id = " . $_SESSION["id"]
  );
} else {
  $update = $db->query(
    "UPDATE USER SET avatar = '0' WHERE id = " . $_SESSION["id"]
  );
}
?>
