<?php
session_start();
include "../../includes/db.php";
$id = htmlspecialchars($_GET["id"]);
if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) { ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../../images/topcook_logo.svg";
$linkCss = "../../css/style.css";
$title = "TopCook - Consultation";
include "../../includes/head.php";
?>
<body>
    <?php include "../../includes/header.php"; ?>
    <?php
    $req = $db->prepare(
      "SELECT pseudo, email, date_birth,rights,image,creation FROM USER WHERE id = :id"
    );
    $req->execute([
      "id" => $id,
    ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $select) { ?>

    <h1>Profil de <?= $select["pseudo"] ?></h1>
    <div class="container">
        <table class="table text-center table-bordered">
            <tr>
                <th>Photo de profil</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Droits</th>
                <th>Date de création de compte</th>
            </tr>
            <tr>
                <td><?php if (!empty($select["image"])) {
                  echo '<img src="../../uploads/' .
                    $select["image"] .
                    '" class="image-users me-3" alt="..." width="50">';
                } ?></td>
                <td><?= $select["pseudo"] ?></td>
                <td><?= $select["email"] ?></td>
                <td><?= $select["date_birth"] ?></td>
                <td><?= $select["rights"] ?></td>
                <td><?= $select["creation"] ?></td>
                
            </tr>
        </table>
    </div>
    <h1>Historiques des messages</h1>
        <h2 class="mt-3 mb-3">Commentaires recette</h2>
        <div class="container">
            <table class="table text-center table-bordered">
                <tr>
                    <th>Recette</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                <?php
                $selectMessage = $db->prepare(
                  "SELECT message, id_recipe, date_send FROM COMMENTAIRE WHERE id_user = :id"
                );
                $selectMessage->execute([
                  "id" => $id,
                ]);
                $result = $selectMessage->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $selectMessage) { ?>
                        <?php
                    $idRecipe = $selectMessage["id_recipe"];
                        $selectRecipe = $db->prepare(
                          "SELECT name FROM RECIPE WHERE id = :id"
                        );
                        $selectRecipe->execute([
                          "id" => $selectMessage["id_recipe"],
                        ]);
                        $result = $selectRecipe->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $selectRecipe) {
                            $nameRecipe = $selectRecipe["name"];
                            ?>
                <tr>
                    <td><a href="https://topcook.site/recipes/recipe.php?name=<?= $nameRecipe ?>&id=<?= $idRecipe ?>"><?= $selectRecipe["name"] ?></a></td>
                    <td><?= $selectMessage["message"] ?></td>
                    <td><?= $selectMessage["date_send"] ?></td>
                </tr>
                <?php }
                }?>
            </table>
        </div>

    <?php }
    ?>
    <h2 class="mt-3 mb-3">Messages topic</h2>
    <div class="container">
        <table class="table text-center table-bordered">
            <tr>
                <th>Topic</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
        </table>
    </div>
    <?php include "../../includes/footer.php"; ?>
    <?php
    $linkJSGeneral = "../../js/app.js";
    $linkJSSearch = "../../js/search.js";
    include "../../includes/scripts.php";
    ?>
</body>
</html>
<?php } else {header("location: http://164.132.229.157/");
  exit();} ?>
