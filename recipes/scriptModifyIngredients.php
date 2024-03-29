<?php
session_start();
include "../includes/db.php";
$id = htmlspecialchars($_GET['id_recipe']);
$id_first = htmlspecialchars($_GET['id_first']);
for ($i = 0; $i < count($_POST['ingredients']); $i++) {
    $ingredient = $_POST['ingredients'][$i];
    $quantity = $_POST['quantity'][$i];
    $unit = $_POST['unit'][$i];

    $updateIngredient = $db->prepare("UPDATE INGREDIENT SET name = :name, quantity = :quantity, unit = :unit WHERE id_recipe = :id_recipe AND id = :id_first");
    $updateIngredient->execute(array(
        'name' => $ingredient,
        'quantity' => $quantity,
        'unit' => $unit,
        'id_recipe' => $id,
        'id_first' => $id_first
    ));
    $id_first = $id_first + 1;
}
header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id&message=Les ingrédients ont bien été modifiés !&type=success");
exit();
