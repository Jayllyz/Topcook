<?php

session_start();
include "../includes/db.php";
if(!isset($_SESSION["rights"]) || $_SESSION["rights"] != 1){
    header("location: https://topcook.site/");
    exit();
}

$selectContest = $db->query("UPDATE CONTEST SET date_end = NOW() WHERE finish = 0");
header("location: https://topcook.site/concours.php?message=Concours arrêté avec succés !&type=success");
exit();
