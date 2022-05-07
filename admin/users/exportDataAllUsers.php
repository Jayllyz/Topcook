<?php
session_start();
include "../../includes/db.php";
if(!isset($_SESSION["id"]) && $_SESSION["rights"] != 1) {
    header("Location: https://topcook.site/");
    exit();
}

$query = $db->query(
    "SELECT id, pseudo, email, date_birth, creation, rights FROM USER ORDER BY id DESC"
);

$filename = "allUsers-data_" . date("Y-m-d") . ".csv";

$f = fopen("php://memory", "w");

$fields = ["ID", "PSEUDO", "EMAIL", "DATE_NAISSANCE", "DATE_INSCRIPTION", "DROITS"];
fputcsv($f, $fields, ";");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $lineData = [
        $row["id"],
        $row["pseudo"],
        $row["email"],
        $row["date_birth"],
        $row["creation"],
        $row["rights"]
    ];
    fputcsv($f, $lineData, ";");
}

fseek($f, 0);

header("Content-Type: text/csv; charset=utf-8");
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);

exit();
