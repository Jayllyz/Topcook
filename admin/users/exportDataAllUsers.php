<?php
session_start();
include "../../includes/db.php";
if (!isset($_SESSION["id"]) && $_SESSION["rights"] != 1) {
    header("Location: https://topcook.site/");
    exit();
}

$query = $db->query(
    "SELECT id, pseudo, email, date_birth, creation, rights FROM USER ORDER BY id DESC"
);
$users = $query->fetchAll(PDO::FETCH_ASSOC);

$filename = "allUsers-data_" . date("Y-m-d") . ".csv";

$f = fopen("php://memory", "w");

$fields = ["ID", "PSEUDO", "EMAIL", "DATE_NAISSANCE", "DATE_INSCRIPTION", "DROITS"];
fputcsv($f, $fields, ";");

foreach ($users as $user) {
    $lineData = [
        $user["id"],
        $user["pseudo"],
        $user["email"],
        $user["date_birth"],
        $user["creation"],
        $user["rights"],
    ];

    fputcsv($f, $lineData, ";");
}
fseek($f, 0);

header("Content-Type: text/csv; charset=utf-8");
header('Content-Disposition: attachment; filename="' . $filename . '";');

fpassthru($f);

exit();
