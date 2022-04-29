<?php

$files = scandir("../images/captcha");
$nbFile = count($files);
$tabFolders = [];
for ($i = 0; $i < $nbFile; $i++) {
  if ($files[$i] != "." && $files[$i] != "..") {
    $tabFolders[] = $files[$i];
  }
}

$rand = rand(0, count($tabFolders) - 1);
$randFolder = $tabFolders[$rand];

echo $randFolder;
