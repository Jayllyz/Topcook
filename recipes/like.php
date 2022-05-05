<?php
session_start();

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
if ($resultLike == 1) {
    $req = $db->prepare(
        "DELETE FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
    );
    $req->execute([
        "id_recipe" => $id,
        "id_user" => $_SESSION["id"],
    ]);
    echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' onclick='like($id)'>";
} else {
    $req = $db->prepare(
        "INSERT INTO LIKES (votes, id_recipe, id_user )VALUES( :votes , :id_recipe , :id_user)"
    );
    $req->execute([
        "votes" => 1,
        "id_recipe" => $id,
        "id_user" => $_SESSION["id"],
    ]);
    echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' class='liked' onclick='like($id)'>";
}
