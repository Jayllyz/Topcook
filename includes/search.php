<?php
$search = trim($_GET['search']);

include ("db.php");
$req = $db->prepare("SELECT id,name FROM RECIPE WHERE name LIKE :name LIMIT 10");
$req->execute(array(
    'name' => "$search" . '%'
));
$result = $req->fetchAll();

foreach ($result as $value) {
    $name = $value['name'];
    $id = $value['id'];
    echo "<p class='text-center fs-4 search_link'><a href='https://topcook.site/recipes/recipe.php?id=$id&name=$name' class='text-decoration-none'>$name</a></p><br>";

}




?>