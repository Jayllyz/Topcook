<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/functions.php";
include "../includes/db.php";
?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Signalements";
include "../includes/head.php";
?>
<body>
<?php include "../includes/header.php"; ?>
<main id="swup" class="transition-fade">
<h1 class="pb-3">Liste des signalements</h1>
<div class="container">
<div id="logs">
            <a href="https://topcook.site/admin/reportReadCom.php" class="btn mb-4 comment_report">Commentaires signalés</a>
            <a href="https://topcook.site/admin/reportReadMsg.php" class="btn ms-4 mb-4 msg_report">Messages signalés</a>
        </div>
    <table class="table text-center table-bordered table-hover" id="active">
        <thead>
            <tr>
                <th>Recettes</th>
                <th>Nombre de signalements</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
        $query = $db->query(
          "SELECT id_recipe, count(id_recipe) FROM REPORT_RECIPE GROUP BY id_recipe"
        );
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $select) { ?>

        <?php
        $getName = $db->prepare(
          "SELECT name  FROM RECIPE WHERE id = :id_recipe"
        );
        $getName->execute([
          "id_recipe" => $select["id_recipe"],
        ]);
        $resultName = $getName->fetch(PDO::FETCH_ASSOC);

        $countSteps = $db->prepare(
          "SELECT COUNT(id) FROM STEPS WHERE id_recipe = :id_recipe"
        );
        $countSteps->execute([
          "id_recipe" => $select["id_recipe"],
        ]);
        $countSteps = $countSteps->fetch(PDO::FETCH_ASSOC);
        $countSteps = $countSteps["COUNT(id)"];
        ?>

        <tbody>
                <tr>
                    <td><?= $resultName["name"] ?></td>
                    <td><?= $select["count(id_recipe)"] ?></td>
                    <td>
                    <div class="button_profil">
                        <a href="../recipes/recipe.php?name=<?= $resultName[
                          "name"
                        ] ?>&id=<?= $select[
  "id_recipe"
] ?>&nbSteps=<?= $countSteps ?>" class="btn-update btn ms-3 me-3">Voir la recette</a><br>
                        
                        <a href="../recipes/deleteRecipe.php?id=<?= $select[
                          "id_recipe"
                        ] ?>&id_user=<?= $session["id"] ?>&name=<?= $resultName[
  "name"
] ?>" onclick="return checkConfirm('Voulez vous vraiment supprimer cette recette?')" class="btn btn-danger btn-ban ms-3 me-3">
                            Supprimer la recette
                        </a>
                    </div>
                    </td>
                </tr>
        </tbody>
    
        <?php }
        ?>
        </table>
</div>
</main>
<script src="https://topcook.site/node_modules/swup/dist/swup.min.js"></script>
<script src="https://topcook.site/js/swup.js"></script>
<?php include "../includes/footer.php"; ?>
<?php include "../includes/scripts.php"; ?>
</body>
</html>
