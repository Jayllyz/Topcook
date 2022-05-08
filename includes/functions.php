<?php

function readLogs($file)
{
  $lines = 0;
  $handle = fopen($file, "r");
  while (!feof($handle)) {
    $line = fgets($handle);
    $lines++;
  }
  fclose($handle);
  return $lines;
}

function moreViewsRecipe()
{
  $nameFile = scandir("log/recipe_logs/");
  $nbFile = count($nameFile);
  $nbFile = $nbFile - 2;
  $tabLogs = [];
  $nbLigneMax = 0;
  $fileMax = 0;
  for ($i = 0; $i < $nbFile; $i++) {
    $tabLogs[$i] = explode(
      "visité",
      file_get_contents("log/recipe_logs/" . $nameFile[$i + 2])
    );

    $nbLigne = count($tabLogs[$i]);
    $nbLigne = $nbLigne - 1;

    $nbLigne = readLogs("log/recipe_logs/" . $nameFile[$i + 2]);
    if ($nbLigne > $nbLigneMax) {
      $nbLigneMax = $nbLigne;
      $fileMax = $nameFile[$i + 2];
    }
  }
  $newFileMax = explode(".txt", $fileMax);
  $newFileMax = $newFileMax[0];
  return $newFileMax;
}

function cutImg($linkImg, $nameFolder)
{
  $countC = 1;
  $countL = 1;

  $img = imagecreatefromjpeg($linkImg);
  $largeur = imagesx($img);
  $hauteur = imagesy($img);
  $largeur_partie = $largeur / 3;
  $hauteur_partie = $hauteur / 3;
  $partie = imagecreatetruecolor($largeur_partie, $hauteur_partie);
  for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
      imagecopy(
        $partie,
        $img,
        0,
        0,
        $largeur_partie * $i,
        $hauteur_partie * $j,
        $largeur_partie,
        $hauteur_partie
      );

      $dir = "/var/www/html/images/captcha/$nameFolder/";
      if (!is_dir($dir)) {
        mkdir($dir, 0777);
      }

      chmod($dir, 0777);
      $dir = $dir . $countL . ".jpg";
      $countL += 3;
      imagejpeg($partie, $dir);
    }
    $countC += 1;
    $countL = $countC;
  }
  imagejpeg($img, "image_build.jpg");
  imagedestroy($img);
}

function likesArray($type)
{
  $getFiles = scandir("log/recipe_$type/");
  $nbFile = count($getFiles);
  for ($i = 0; $i < $nbFile; $i++) {
    if ($getFiles[$i] !== "." && $getFiles[$i] !== "..") {
      $files[] = $getFiles[$i];
    }
  }

  $nbFile = count($files);
  $nbLikes = 0;
  $tabLikes = [];
  for ($i = 0; $i < $nbFile; $i++) {
    $nbLikes = 0;
    $Alllines = file("log/recipe_$type/" . $files[$i]);
    $nbLines = count($Alllines);
    for ($j = 0; $j < $nbLines; $j++) {
      $line = explode(" ", $Alllines[$j]);
      $date = explode("/", $line[3]);

      if ($date[1] == date("m") && $date[2] == date("Y")) {
        $nbLikes++;

        $tabLikes[$files[$i]] = $nbLikes;
      }
    }
  }
  return $tabLikes;
}

//most likes recipes during the month
function topLikesRecipesMonth()
{
  $arrayLikes = likesArray("likes");

  $arrayDislikes = likesArray("dislikes");
  foreach ($arrayLikes as $key => $value) {
    $arrayLikes[$key] = $value - $arrayDislikes[$key];
  }
  arsort($arrayLikes);
  return array_slice($arrayLikes, 0, 4);
}

function banword($banlist, $text, $db, $insert)
{
  $banlist = file_get_contents($banlist);

  $tabBan = explode("\n", $banlist);

  for ($i = 0; $i < count($tabBan); $i++) {
    $tabBan[$i] = trim($tabBan[$i]);
  }

  $tabBan = array_filter($tabBan);

  for ($i = 0; $i < count($tabBan); $i++) {
    $tabBan[$i] = "/" . $tabBan[$i] . "/i";
  }
  if ($insert === 0) {
    $text = preg_replace($tabBan, "*****", $text); //on remplace les mots bannis par *****
  } else {
    $count = 0;
    $text = preg_replace($tabBan, "*****", $text, -1, $count);
    for ($i = 0; $i < $count; $i++) {
      $db->query("UPDATE USER SET nbBottle = nbBottle + 1 WHERE id = " . $_SESSION['id']);
    }
    return $count;
  }

  return $text;
}

function viewElement($db, $table)
{
  $select = $db->query("SELECT id, image FROM " . $table);
  return $select->fetchAll(PDO::FETCH_ASSOC);
}

function getAvatar($db, $type, $idUser)
{
  $lower = strtolower($type);
  $upper = strtoupper($type);

  $select = $db->query("SELECT $lower FROM AVATAR WHERE idUser = " . $idUser);
  $select = $select->fetch(PDO::FETCH_ASSOC);
  $result = $select[$lower];
  if ($result === null) {
    return false;
  }
  $selectImg = $db->query("SELECT image FROM $upper WHERE id = " . $result);
  $selectImg = $selectImg->fetch(PDO::FETCH_ASSOC);
  $selectImg = $selectImg["image"];
  return $selectImg;
}
