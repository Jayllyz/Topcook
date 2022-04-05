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
    <form method="post" action="../verifications/add_ingredients.php" id="ingredients">
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
            <button type="submit" name="submit" class="btn mt-3" data-bs-dismiss="modal">Envoyer</button>
    </form>

</main>
<?php include "../includes/footer.php"; ?>
<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<body>
    
</body>
</html>