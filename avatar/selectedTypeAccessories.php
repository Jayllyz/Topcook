<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
if(!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}

$type = $_GET['type'];

$selectTypeAccessories = $db->query("SELECT id, image FROM ".$type);

if($type !== "Choisir un type d'accessoire"){
    $result = $selectTypeAccessories->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $images = $row['image'];
        $id = $row['id'];
        echo "<div class='col col-md-3 accessories me-1 mb-2'>";
        echo $images;
        echo "<button class='btn btn-primary' id=$id onclick='addElement(this.id)'>Ajouter</button>";
        echo "</div>";

    }
}
