<?php

// count lines in file
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
    //echo $tabLogs[$i][0] . "<br>";
    // count nb de ligne dans chaque fichier
    $nbLigne = count($tabLogs[$i]);
    $nbLigne = $nbLigne - 1;
    //echo $nbLigne . "<br>";
    // fichier qui contient le plus de ligne
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
  $compteur = 0;
  $img = imagecreatefromjpeg($linkImg);
  $largeur = imagesx($img);
  $hauteur = imagesy($img);
  $largeur_partie = $largeur / 3;
  $hauteur_partie = $hauteur / 3;
  for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
      $partie = imagecreatetruecolor($largeur_partie, $hauteur_partie);
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
      $compteur++;
      chmod($dir, 0777);
      $dir = $dir . "image" . $compteur . ".jpg";
      imagejpeg($partie, $dir);
    }
  }
  imagejpeg($img, "image_build.jpg");
  imagedestroy($img);
}

function likesArray($type)
{
  $files = scandir("log/recipe_$type/");
  $nbFile = count($files);
  $nbLikes = 0;
  for ($i = 0; $i < $nbFile; $i++) {
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
// filter arrayLikes decreasing
  arsort($arrayLikes);
  return array_slice($arrayLikes, 0, 4);

}

?>
