<?php
session_start();
include "../includes/db.php";

$query = $db->query(
  "SELECT id, pseudo, email, date_birth, creation FROM USER WHERE id = " .
    $_SESSION["id"]
);

$filename = "user-data_" . date("Y-m-d") . ".pdf";

$f = fopen("php://memory", "w");

$fields = ["ID", "PSEUDO", "EMAIL", "DATE_NAISSANCE", "DATE_INSCRIPTION"];
fputcsv($f, $fields, ";");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $lineData = [
    $row["id"],
    $row["pseudo"],
    $row["email"],
    $row["date_birth"],
    $row["creation"],
  ];
  fputcsv($f, $lineData, ";");
}

fseek($f, 0);

header("Content-Type: application/pdf; charset=utf-8");
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);

exit();

?>
