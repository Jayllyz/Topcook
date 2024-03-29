<?php
session_start();
include('../includes/functions.php');
include('../includes/db.php');
$selectBottle = $db->query("SELECT SUM(nbBottle) FROM USER");
$bottle = $selectBottle->fetch(PDO::FETCH_ASSOC);
$bottle = $bottle['SUM(nbBottle)'];
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
    <main>
        <h1 class="pb-3">Liste des logs</h1>
        <div class="container">
            <table class="table text-center table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre de connexion</th>
                        <th>Nombre de bannis</th>
                        <th>Nombre d'erreurs de connexion</th>
                        <th>Total des bouteilles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= readLogs("../log/log_success.txt") ?></td>
                        <td><?php
                            $linesBan = readLogs("../log/log_ban.txt") - readLogs("../log/log_deban.txt");
                            echo $linesBan;
                            ?></td>
                        <td><?= readLogs("../log/log_errors.txt") ?></td>
                        <td><?= $bottle ?></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "../includes/footer.php"; ?>
    <?php
    include "../includes/scripts.php";
    ?>
</body>

</html>