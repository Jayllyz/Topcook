<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
$date = date("d/m/Y H:i:s");
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
    $log_dislike = fopen("../log/recipe_dislikes/$id.txt", "a+");
    fputs($log_dislike, $name . " ");
    fputs($log_dislike, "disliké le ");
    fputs($log_dislike, $date);
    fputs($log_dislike, "par ");
    fputs($log_dislike, $_SESSION["id"]);
    fputs($log_dislike, "\n");
    fclose($log_dislike);
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
    $log_recipe = fopen("../log/recipe_likes/$id.txt", "a+");
    fputs($log_recipe, $name . " ");
    fputs($log_recipe, "liké le ");
    fputs($log_recipe, $date);
    fputs($log_recipe, "par ");
    fputs($log_recipe, $_SESSION["id"]);
    fputs($log_recipe, "\n");
    fclose($log_recipe);
    echo "<img src='../images/like.svg' id='isLiked' alt='like' width='30' height='30' class='liked' onclick='like($id)'>";
}
