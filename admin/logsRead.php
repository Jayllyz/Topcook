<?php
session_start();
include ('../includes/functions.php');
?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Logs";
include "../includes/head.php";
?>
<body>
<?php include "../includes/header.php"; ?>
<h1 class="pb-3">Liste des logs</h1>
<div class="container">
    <table class="table text-center table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre de connexion</th>
                <th>Nombre de bannis</th>
                <th>Nombre d'erreurs de connexion</th>
                <th>Page la plus visitée</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= readLogs("../log/log_success.txt") ?></td>
            <td><?php
                $linesBan = readLogs("../log/log_ban.txt") - readLogs("../log/log_deban.txt");
                echo $linesBan;
                ?></td>
            <td><?= readLogs("../log/log_errors.txt")?></td>
            <td>A venir...</td>

        </tr>
        </tbody>
        </table>
</div>


<?php include "../includes/footer.php"; ?>
<?php
$linkJSGeneral = "../js/app.js";
$linkJSSearch = "../js/search.js";
include "../includes/scripts.php";
?>
</body>
</html>
