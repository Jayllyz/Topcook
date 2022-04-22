<?php
session_start();
include "../../includes/db.php";
$test = $_POST["msg"];

$sql = $db->query("INSERT INTO TEST (message) VALUES (:test)");
$sql->execute([
  "test" => $test,
]);

?>
