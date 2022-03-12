<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Connexion";
include "includes/head.php";
?>
<body>
    <?php include "includes/header.php"; ?>
    <main>
        <h1>Connexion</h1>
        <div class="container col-md-6">
            <?php include "includes/message.php"; ?>
        </div>
        <form action="verifications/verification_connexion.php" method="post">
            <div class="container col-md-4" id="form" >
                <div class="mb-3">
                    <label for="login" class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" name="login">
                </div>
                    <label for="password" class="form-label"><strong>Mot de passe</strong></label>
                    <input type="password" class="form-control" name="password" id="password">
                    <label class="form-label">Voir mon mot de passe</label>
                    <input type="checkbox" class="form-check-input" onClick="viewPassword()">
                    
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" name="checkbox">
                    <label for="stay-connected">Rester connecté</label>
                </div>
                <button type="submit" name="submit" class="btn">Envoyer</button>
            </div>
        </form>
          
    </main>
    <?php include "includes/footer.php"; ?>
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>