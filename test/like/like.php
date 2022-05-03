<?php
session_start();
include '../../includes/db.php';
$id = $_POST['id'];

$req = $db->prepare(
    "INSERT INTO LIKES (votes, id_recipe, id_user )VALUES( :votes , :id_recipe , :id_user)"
);
$req->execute([
    "votes" => 1,
    "id_recipe" => $id,
    "id_user" => $_SESSION["id"],
]);




?>
