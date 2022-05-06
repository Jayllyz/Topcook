<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$id = $_POST['id'];
$selectParticipate = $db->query("SELECT id , idContest, imageContest FROM USER  WHERE imageContest != 'NULL' ORDER BY id ASC");
$resultParticipate = $selectParticipate->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultParticipate as $participate) {
    $idParticipate = $participate['id'];
    $idContest = $participate['idContest'];




    $selectLike = $db->prepare(
        "SELECT votes FROM LIKES_CONTEST WHERE id_contest = :id_contest AND id_user = :id_user"
    );
    $selectLike->execute([
        "id_contest" => $idContest,
        "id_user" => $_SESSION['id']
    ]);
    $resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
    if ($resultLike === 1) {
        $req = $db->prepare(
            "DELETE FROM LIKES_CONTEST WHERE id_user = :id_user AND id_contest = :id_contest"
        );
        $req->execute([
            "id_contest" => $idContest,
            "id_user" => $_SESSION['id']
        ]);
        echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' onclick='likeContest($idParticipate)'>";
    } else {
        $req = $db->prepare(
            "INSERT INTO LIKES_CONTEST (id_user, id_contest, votes) VALUES(:id_user, :id_contest, 1)"
        );
        $req->execute([
            "id_user" => $_SESSION['id'],
            "id_contest" => $idContest,

        ]);
        echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' class='liked' onclick='likeContest($idParticipate)'>";
    }
}
