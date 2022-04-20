<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';

$query = $db->query("SELECT id, pseudo, email, date_birth, creation FROM USER WHERE id = ".$_SESSION['id']);

$delimiter = ",";
$filename = "user-data_" . date('Y-m-d') . ".csv";

$f = fopen('php://memory', 'w');


$fields = array('ID', 'PSEUDO', 'EMAIL', 'DATE_NAISSANCE', 'DATE_INSCRIPTION');
fputcsv($f, $fields, $delimiter);

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $lineData = array($row['id'], $row['pseudo'], $row['email'], $row['date_birth'], $row['creation']);
    fputcsv($f, $lineData, $delimiter);
}

fseek($f, 0);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);

exit;

?>