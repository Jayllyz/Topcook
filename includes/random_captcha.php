<?php
include "function.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$files = scandir("https://topcook.site/images/captcha");
$nbFile = count($files);
$tabFolders = [];
for ($i = 0; $i < $nbFile; $i++) {
  $tabFolders[$i] = $files[$i];
}
$number = count($tabFolders);
$random = rand(0, $number - 1);
echo $tabFolders[$random];
