<?php

// count lines in file
function readLogs($file) {
    $lines = 0;
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $line = fgets($handle);
        $lines++;
    }
    fclose($handle);
    return $lines;
}


function moreViewsRecipe(){
    $nameFile = scandir("log/recipe_logs/");
    $nbFile = count($nameFile);
    $nbFile = $nbFile - 2;
    $tabLogs = array();
    for ($i = 0; $i < $nbFile; $i++) {
        $tabLogs[$i] = explode("visité", file_get_contents("log/recipe_logs/" . $nameFile[$i + 2]));
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


?>