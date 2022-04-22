<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Ajax</title>
</head>
<body>


<select name="message" id="message" onchange="changeSweet()">
    <option value="start">----Selectionner une couleur du vetement----</option>
    <option value="brown">Marron</option>
    <option value="green">Vert</option>
</select>
<input type="submit" name="submit" onclick="insert()" value="Envoyer">

<script src="js/app.js"></script>
</body>
</html>
