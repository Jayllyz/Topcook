<?php
session_start();
$search = htmlspecialchars($_GET['search']);

include ("db.php");

// Select Recipe

$searchRecipe = $db->prepare("SELECT id,name FROM RECIPE WHERE name LIKE :name LIMIT 10");
$searchRecipe->execute(array(
    'name' => '%'. "$search" . '%'
));
$resultRecipe = $searchRecipe->fetchAll(PDO::FETCH_ASSOC);
if($resultRecipe){
    echo "<p class='fs-5 search_link'><em><strong>Recettes</strong></em></p>";
}

foreach ($resultRecipe as $recipe) {
    $name = $recipe['name'];
    $idRecipe = $recipe['id'];
    echo "<p class='fs-5 search_link'><a href='https://topcook.site/recipes/recipe.php?id=$idRecipe&name=$name' class='text-decoration-none'>$name</a></p>";

}

// Select Topic

$searchTopic = $db->prepare("SELECT id,subject, id_user FROM TOPIC WHERE subject LIKE :subject LIMIT 10");
$searchTopic->execute(array(
    'subject' => '%'. "$search" . '%'
));

$resultTopic = $searchTopic->fetchAll(PDO::FETCH_ASSOC);
if($resultTopic){
    echo "<hr>";
    echo "<p class='fs-5 search_link'><em><strong>Topics</strong></em></p>";
}
foreach ($resultTopic as $topic) {

    $selectIdPseudoUser = $db->prepare("SELECT id, pseudo FROM USER WHERE id = :id_user");
    $selectIdPseudoUser->execute(array(
        'id_user' => $topic['id_user']
    ));
    $resultIdPseudoUser = $selectIdPseudoUser->fetch(PDO::FETCH_ASSOC);
    $pseudoCreator = $resultIdPseudoUser['pseudo'];
    $idCreator = $resultIdPseudoUser['id'];
    $subject = $topic['subject'];
    $idTopic = $topic['id'];
    echo "<p class='fs-5 search_link'><a href='https://topcook.site/forum/subject.php?id_subject=$idTopic&creator=$pseudoCreator&id_creator=$idCreator' class='text-decoration-none'>$subject</a></p>";
}

// Select User

if(
    isset($_SESSION['rights']) &&
    $_SESSION['rights'] == 1) {
    $selectUser = $db->prepare("SELECT id,pseudo FROM USER WHERE pseudo LIKE :pseudo LIMIT 10");
    $selectUser->execute(array(
        'pseudo' => '%' . "$search" . '%'
    ));
    $resultUser = $selectUser->fetchAll(PDO::FETCH_ASSOC);
    if($resultUser){
        echo "<hr>";
        echo "<p class='fs-5 search_link'><em><strong>Utilisateurs</strong></em></p>";
    }
    foreach ($resultUser as $user) {
        $pseudo = $user['pseudo'];
        $idUser = $user['id'];
        echo "<p class='fs-5 search_link'><a href='https://topcook.site/admin/users/read.php?id=$idUser' class='text-decoration-none'>$pseudo</a></p>";

    }

}
if(!$resultTopic && !$resultRecipe || isset($resultUser) && !$resultUser){
    echo "<p class='fs-5'>Aucun résultat</p>";
}

