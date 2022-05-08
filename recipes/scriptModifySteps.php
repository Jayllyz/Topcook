<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
include "../includes/db.php";
$id_recipe = htmlspecialchars($_GET['id_recipe']);
$id = htmlspecialchars($_GET['id_steps']);
for ($i = 0; $i < count($_POST['steps']); $i++) {
    $details = $_POST['steps'][$i];

    $updateSteps = $db->prepare("UPDATE STEPS SET details = :details WHERE id_recipe = :id_recipe AND id = :id AND orders = :orders");
    $updateSteps->execute(array(
        'details' => $details,
        'id_recipe' => $id_recipe,
        'id' => $id,
        'orders' => $i
    ));
}
header("location: https://topcook.site/recipes/recipe.php?name=$name&id=$id_recipe&message=Les étapes ont bien été modifiés !&type=success");
exit();
