<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include "../../includes/functions.php";




// Delete file after one month
$file = "../../data/puzzle/decoupe.txt";
if (file_exists($file)) {
    $time = time() - filemtime($file);
    if ($time > 2592000) {
        unlink($file);
    }
}

$file = "hahaha.php";
if (file_exists($file)) {
    unlink($file);
}



?>