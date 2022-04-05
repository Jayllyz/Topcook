<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "$_GET[name]";
include "../includes/head.php";
?>
<?php include "../includes/header.php"; ?>
<main>
    <form method="post" action="../verifications/add_ingredients.php">
            <div class="ingredients">
                <div>
                    <label class="form-label">Ingredients :</label>
                </div>
                <div class="logo-add-remove-ingredients">
                            <img src="../images/plus-lg.svg" id="plus" onclick="addIngredients()">
                            <img src="../images/dash-lg.svg" id="minus" onclick="removeIngredients()">
                        </div>
                        </label>
                    </div>
                <input type="text" name="ingredients[]" class="form-control steps-input" placeholder="Ingredients 1" required>
            <div id="new-ingredients" class="1"></div>
    </form>

</main>
<?php include "../includes/footer.php"; ?>

<body>
    
</body>
</html>