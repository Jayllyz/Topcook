<?php session_start();
include "includes/db.php";
if (isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html lang="fr">
    <?php
    $linkLogoOnglet = "images/topcook_logo.svg";
    $linkCss = "css/style.css";
    $title = "TopCook - Mes favoris";
    include "includes/head.php";
    ?>

    <body>

        <?php include "includes/header.php"; ?>
        <h1>Mes favoris</h1>
        <?php
        $selectRecipe = $db->query("SELECT id, name, images, type, description FROM RECIPE");
        $resultRecipe = $selectRecipe->fetchAll(PDO::FETCH_ASSOC);
        $selectFavorites = $db->query("SELECT idRecipe, idUser FROM FAVORITE_RECIPE WHERE idUser = " . $_SESSION['id']);
        $resultFavorites = $selectFavorites->fetchAll(PDO::FETCH_ASSOC);

        if (empty($resultFavorites)) {
            echo "<div class='container'>";
            echo "<p class='fs-3 text-center alert alert-warning'> Vous n'avez pas de favoris</p>";
            echo "</div>";
        } else {
            echo "<div class='container g-1'>";
            echo "<div class='row'>";

            foreach ($resultFavorites as $favorite) {
                foreach ($resultRecipe as $recipe) {

                    if ($favorite['idRecipe'] == $recipe['id']) {
                        $countSteps = $db->prepare(
                            "SELECT COUNT(id) FROM STEPS WHERE id_recipe = :id_recipe"
                        );
                        $countSteps->execute([
                            "id_recipe" => $recipe["id"],
                        ]);
                        $countSteps = $countSteps->fetch(PDO::FETCH_ASSOC);
                        $countSteps = $countSteps["COUNT(id)"];
                        $recipe['id'] = $favorite['idRecipe'];
                        $recipe['idUser'] = $_SESSION['id'];
                        $recipes[] = $recipe;


                        echo "<div class='col-md-4'>";
                        echo "<a href='recipes/recipe.php?id=" .
                            $recipe['id'] .
                            "&name=" .
                            $recipe['name'] .
                            "&nbSteps=" .
                            $countSteps .
                            "' class='text-decoration-none text-dark'>";
                        echo "<img src='uploads/recipe/" . $recipe['images'] . "' class='img-fluid allrecipes' alt='" . $recipe['name'] . "'>";
                        echo "<p class='fs-3 text-center'>" . $recipe['name'] . "</p>";
                        echo "</a>";
                        echo "</div>";
                    }
                }
            }
            echo "</div>";
            echo "</div>";
        }

        ?>

        <?php include "includes/footer.php"; ?>
        <?php include "includes/scripts.php"; ?>
    </body>

    </html>
<?php
} else {
    header("Location: https://topcook.site/");
    exit();
} ?>