<?php
session_start();
$id_recipe = htmlspecialchars($_GET['id']);
$name_recipe = htmlspecialchars($_GET['name']);
$nbSteps = htmlspecialchars($_GET['nbSteps']);
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "$name_recipe";
include "../includes/head.php";
?>
<?php include "../includes/header.php"; ?>
<main>
    <form method="post" action="../verifications/add_ingredients.php?name=<?=$name_recipe?>&id_recipe=<?=$id_recipe?>&nbSteps=<?=$nbSteps?>" id="ingredients">
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
        <div class="new-ingredients">
            <input type="text" name="ingredients[]" class="form-control steps-input ingredient" placeholder="Ingredients 1" required>
            <input type="number" name="quantity[]" class="form-control steps-input quantity" placeholder="Quantitée" required>
            <select name="unit[]" class="form-control steps-input unit">
                <option value="g">g</option>
                <option value="cl">cl</option>
            </select>
        </div>
            <div id="new-ingredients" class="1">
            </div>
            <button type="submit" name="submit" class="btn mt-3" data-bs-dismiss="modal">Envoyer</button>
    </form>

</main>
<?php include "../includes/footer.php"; ?>
<?php
$linkJSGeneral = "../js/app.js";
$linkJSSearch = "../js/search.js";
include "../includes/scripts.php";
?>
<body>
    
</body>
</html>