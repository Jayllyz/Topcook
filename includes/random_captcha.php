<?php
include "function.php";
$array = [];
$array = readFolders();

echo $array[$_GET["id"]];
