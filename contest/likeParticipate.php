<?php
session_start();
include '../includes/db.php';
if(!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}
$id = $_POST['id'];
$select = $db->prepare("SELECT idContest FROM USER WHERE id = :id");
$select->execute([
    "id" => $id
]);
$result = $select->fetch(PDO::FETCH_ASSOC);
$idContest = isset($result['idContest']) ? $result['idContest'] : null;

$selectLike = $db->prepare(
    "SELECT votes FROM LIKES_CONTEST WHERE id_contest = :id_contest AND id_user = :id_user AND id_proposal = :id_proposal"
);
$selectLike->execute([
    "id_contest" => $idContest,
    "id_user" => $_SESSION['id'],
    "id_proposal" => $id
]);
$resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));

if ($resultLike === 1) {
    $req = $db->prepare(
        "DELETE FROM LIKES_CONTEST WHERE id_user = :id_user AND id_contest = :id_contest AND id_proposal = :id_proposal"
    );
    $req->execute([
        "id_contest" => $idContest,
        "id_user" => $_SESSION['id'],
        "id_proposal" => $id
    ]);
    echo $id . "," . "unliked";
} else {
    $req = $db->prepare(
        "INSERT INTO LIKES_CONTEST (id_user, id_contest, votes, id_proposal) VALUES (:id_user, :id_contest, :votes, :id_proposal)"
    );
    $req->execute([
        "id_user" => $_SESSION['id'],
        "id_contest" => $idContest,
        "votes" => 1,
        "id_proposal" => $id
    ]);
    echo $id . "," . "liked";

}
