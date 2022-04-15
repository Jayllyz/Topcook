<?php
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
    echo "<p class='fs-5 search_link'><a href='https://topcook.site/recipes/recipe.php?id=$id&name=$name' class='text-decoration-none'>$name</a></p><hr>";
}

?>