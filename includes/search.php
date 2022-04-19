<?php
session_start();
$search = trim(htmlspecialchars($_GET['search']));

include ("db.php");

$req = $db->prepare("SELECT id,name FROM RECIPE WHERE name LIKE :name LIMIT 10");
$req->execute(array(
    'name' => '%'. "$search" . '%'
));
$result = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $value) {
    $name = $value['name'];
    $id = $value['id'];
    echo "<p class='fs-5 search_link'><a href='https://topcook.site/recipes/recipe.php?id=$id&name=$name' class='text-decoration-none'>$name</a></p>";

}
if($_SESSION['rights'] == 1) {
    echo "<hr>";
    $selectUser = $db->prepare("SELECT id,pseudo FROM USER WHERE pseudo LIKE :pseudo LIMIT 10");
    $selectUser->execute(array(
        'pseudo' => '%' . "$search" . '%'
    ));
    $resultUser = $selectUser->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultUser as $value) {
        $pseudo = $value['pseudo'];
        $id = $value['id'];
        echo "<p class='fs-5 search_link'><a href='https://topcook.site/admin/users/read.php?id=$id' class='text-decoration-none'>$pseudo</a></p>";
    }
}
?>