<?php
$username = "topcook";
$password = "TopCook.2022#ESGI";
try {
  $db = new PDO(
    "mysql:host=164.132.229.157:3307;dbname=topcook",
    $username,
    $password
  );
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>
