<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$id = $_POST['id'];
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES WHERE id_recipe = :id_recipe AND id_user = :id_user"
);
$selectLike->execute([
    "id_recipe" => $id,
    "id_user" => $_SESSION['id']
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
if($resultLike == 1){
    $req = $db->prepare(
        "DELETE FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
    );
    $req->execute([
        "id_recipe" => $id,
        "id_user" => $_SESSION["id"],
    ]);
}else{
    $req = $db->prepare(
        "INSERT INTO LIKES (votes, id_recipe, id_user )VALUES( :votes , :id_recipe , :id_user)"
    );
    $req->execute([
        "votes" => 1,
        "id_recipe" => $id,
        "id_user" => $_SESSION["id"],
    ]);
}





/*
if ($countLikeUser > 1) {
    $req = $db->prepare(
        "DELETE FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
    );
    $req->execute([
        "id_recipe" => $id,
        "id_user" => $_SESSION["id"],
    ]);
}*/




?>
