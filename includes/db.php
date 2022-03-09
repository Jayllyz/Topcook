<?php
$username = 'topcook';
$password = 'TopCook.2022#ESGI';
try {
  $db = new PDO('mysql:host=164.132.229.157:3306;dbname=topcook', $username, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $e){
  echo "Erreur : " . $e->getMessage();
}
 ?>
