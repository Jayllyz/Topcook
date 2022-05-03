<?php
session_start();
include "../../includes/db.php";
$id = $_POST['id'];

$req = $db->prepare(
    "DELETE FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
);
$req->execute([
    "id_recipe" => $id,
    "id_user" => $_SESSION["id"],
]);
?>
