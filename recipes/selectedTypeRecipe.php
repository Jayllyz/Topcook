<?php
include "../includes/db.php";

$typeRecipe = $_GET['typeRecipe'];

$selectTypeRecipe = $db->prepare("SELECT id, name, images FROM RECIPE WHERE type = :typeRecipe");
$selectTypeRecipe->execute([
    'typeRecipe' => $typeRecipe
]);


$result = $selectTypeRecipe->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $images = $row['images'];
    $id = $row['id'];
    echo "<div class='col col-md-3'>";
    echo "<a href='recipes/recipe.php?name=$name&id=$id'>";
    echo "<img src='../uploads/recipe/$images' alt='$name' class='img-fluid allrecipes'>";
    echo "</a>";
    echo "<h4 class='text-center mb-3 mt-3'>$name</h4>";
    echo "</div>";
}
