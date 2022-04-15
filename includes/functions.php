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
        // count nb de ligne dans chaque fichier
        $nbLigne = count($tabLogs[$i]);
        $nbLigne = $nbLigne - 1;
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
function cutImg($linkImg,$nameFolder) {
    $compteur = 0;
    $img = imagecreatefromjpeg($linkImg);
    $largeur = imagesx($img);
    $hauteur = imagesy($img);
    $largeur_partie = $largeur / 3;
    $hauteur_partie = $hauteur / 3;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $partie = imagecreatetruecolor($largeur_partie, $hauteur_partie);
            imagecopy($partie, $img, 0, 0, $largeur_partie * $i, $hauteur_partie * $j, $largeur_partie, $hauteur_partie);

            $dir = "/var/www/html/images/captcha/$nameFolder/";
            if (!is_dir($dir)) {
                mkdir($dir,0777);

            }
            $compteur++;
            chmod($dir, 0777);
            $dir = $dir . "image". $compteur . ".jpg";
            imagejpeg($partie, $dir);
        }
    }
    imagejpeg($img, "image_build.jpg");
    imagedestroy($img);
}

//broken
function topLikesRecipes($rank) {
    $sql = $db->query("SELECT id_recipe FROM LIKES ORDER BY votes DESC LIMIT " . $rank);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    $sql = $db->prepare("SELECT name FROM recipe WHERE id = :id_recipe");
    $sql->execute(array(
        'id_recipe' => $result[$rank]['id_recipe']
    ));
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result);
    echo $result;
}

?>