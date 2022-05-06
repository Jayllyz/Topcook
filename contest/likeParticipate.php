<?php
session_start();

include '../includes/db.php';
$id = $_POST['id'];
$selectLike = $db->prepare(
    "SELECT votes FROM LIKES_CONTEST WHERE id_contest = :id_contest AND id_user = :id_user"
);
$selectLike->execute([
    "id_contest" => $id,
    "id_user" => $_SESSION['id']
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
if ($resultLike == 1) {
    $req = $db->prepare(
        "DELETE FROM LIKES_CONTEST WHERE id_user = :id_user AND id_contest = :id_contest"
    );
    $req->execute([
        "id_contest" => $id,
        "id_user" => $_SESSION["id"],
    ]);
    echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' onclick='likeContest($id)'>";
} else {
    $req = $db->prepare(
        "INSERT INTO LIKES_CONTEST (votes, id_contest, id_user )VALUES( :votes , :id_contest , :id_user)"
    );
    $req->execute([
        "votes" => 1,
        "id_contest" => $id,
        "id_user" => $_SESSION["id"],
    ]);
    echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' class='liked' onclick='likeContest($id)'>";
}
