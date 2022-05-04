<?php
session_start();
include "../includes/db.php";
$idContest = $_POST['id'];


$selectUserIsVoted = $db->prepare("SELECT participateContest FROM USER WHERE id = :id");
$selectUserIsVoted->execute([
    'id' => $_SESSION['id']
]);
$selectUserIsVoted = $selectUserIsVoted->fetch(PDO::FETCH_ASSOC);
if($selectUserIsVoted['participateContest'] == 0){
    $updateUserIsVoted = $db->prepare("UPDATE USER SET participateContest = 1 WHERE id = :id");
    $updateUserIsVoted->execute([
        'id' => $_SESSION['id']

    ]);

    $insertLike = $db->prepare("UPDATE PARTICIPATE SET likes = likes + 1 WHERE id = :id");
    $resultLike = $insertLike->execute([
        'id' => $idContest
    ]);
}else{
    die("error");
}



$selectLike = $db->prepare("SELECT likes FROM PARTICIPATE WHERE id = :id");
$selectLike->execute([
    'id' => $idContest
]);
$resultSelectLike = $selectLike->fetch(PDO::FETCH_ASSOC);
$likes = $resultSelectLike['likes'];


if ($resultSelectLike) {
    echo $likes;
}







?>
