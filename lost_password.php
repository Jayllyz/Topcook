<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Mot de passe oublié";
include "includes/head.php";
?>
<body>
    <?php include "includes/header.php"; ?>

    <form action="verifications/update_password.php" method="post">
            <div class="container col-md-4" id="form" >
                <div class="mb-3">
                    <label for="login" class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" name="email"><br>
                    <button type="submit" name="submit" class="btn">Envoyer</button>
                </div>
            </div>
    </form>


    <?php include "includes/footer.php"; ?>
</body>
</html>