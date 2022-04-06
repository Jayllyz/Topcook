<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$id_recipe = htmlspecialchars($_GET['id_recipe']);
$name_recipe = htmlspecialchars($_GET['name']);
$nbSteps = htmlspecialchars($_GET['nbSteps']);
for ($i = 0; $i < count($_POST['ingredients']); $i++) {
    $ingredient = $_POST['ingredients'][$i];
    $quantity = $_POST['quantity'][$i];

    $insertIngredient = $db->prepare("INSERT INTO INGREDIENT (name, quantity, id_recipe) VALUES (:name, :quantity, :id_recipe)");
    $insertIngredient->execute(array(
        'name' => $ingredient,
        'quantity' => $quantity,
        'id_recipe' => $id_recipe
    ));

}
header("location: ../recipes/recipe.php?name=$name_recipe&id_recipe=$id_recipe&nbSteps=$nbSteps&message=Les ingrédients ont bien été ajoutés !&type=success");
exit();

?>