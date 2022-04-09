<?php session_start();
include "../includes/db.php";

if (isset($_SESSION["id"])) { ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Mes recettes";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <h1 class="pb-3 text-center">Mes recettes</h1>

        <?php
        $query = $db->prepare(
            "SELECT id, name, images FROM RECIPE WHERE id_user = :id_user ORDER BY id DESC"
        );
        $query->execute([
            "id_user" => $_SESSION["id"]
        ]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container g-1" id="recettes">
            <div class="pb-4 row">
                <?php foreach ($result as $select) {
                        $name_recipe = $select["name"];
                        $id_recipe = $select["id"];
                    ?>
                    <div class="col col-md-3 shadow-sm" id="my_recipe">
                        <a href="https://topcook.site/recipes/recipe.php?name=<?=$name_recipe?>&id=<?=$id_recipe?>" class="text-decoration-none">
                        <?= '<img src="../uploads/recipe/' . $select["images"] . '" class="rounded img-fluid" alt="image -' . $select['names'] . '">'; ?>
                        <h4 class="text-center mt-3 text-dark"><?= $select['name'] ?></h4>
                        </a>
                    </div>


                <?php } ?>
            </div>
        </div>
    </main>
    <?php include "../includes/footer.php"; ?>
    <?php
    $linkJSGeneral = "../js/app.js";
    $linkJSSearch = "../js/search.js";
    include "../includes/scripts.php";
    ?>
</body>
</html>
<?php } else {header("location: ../index.php");
  exit();} ?>
