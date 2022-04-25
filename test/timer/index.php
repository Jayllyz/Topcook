<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timer</title>
</head>
<body>
<h1>Timer</h1>

<div id="timer">
    <div id="days"></div> Jours
    <div id="hours"></div> Heures
    <div id="minutes"></div> Minutes
    <div id="seconds"></div> Secondes
</div>

<form action="" method="post">
    <input type="text" name="text">
    <input type="submit" value="Envoyer">
</form>
<?php
function banword($banlist,$text){
    $banlist = file_get_contents($banlist); //on récupère la liste de mots bannis

    $tabBan = explode("\n", $banlist); //on la transforme en tableau

    $nbBan = count($tabBan);

    for ($i = 0; $i < $nbBan; $i++) {
        $tabBan[$i] = trim($tabBan[$i]);
    }

    $tabBan = array_filter($tabBan); //on supprime les éléments vides

    $nbBan = count($tabBan);
    for ($i = 0; $i < $nbBan; $i++) {
        $tabBan[$i] = "/" . $tabBan[$i] . "/";
    }
    $text = preg_replace($tabBan, "*****", $text); //on remplace les mots bannis par *****

    return $text;
}
$text = $_POST['text'];
$text = banword("banlist.txt",$text);
echo $text;
?>

<script src="js/app.js"></script>
</body>
</html>
