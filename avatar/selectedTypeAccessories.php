<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

$type = $_GET['type'];

$selectTypeAccessories = $db->query("SELECT id, image FROM ".$type);


$result = $selectTypeAccessories->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $images = $row['image'];
    $id = $row['id'];
    echo "<div class='col col-md-3 accessories me-1 mb-2'>";
    echo $images;
    echo "<button class='btn btn-primary' id=$id onclick='addElement(this.id)'>Ajouter</button>";
    echo "</div>";


}
?>
