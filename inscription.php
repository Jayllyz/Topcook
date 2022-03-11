<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Inscription";
include "includes/head.php";
?>

<body>
    <?php include "includes/header.php"; ?>
    <main>
        <h1>Inscription</h1>
        <div class="formulaire">
            <form id="form" class="container col-md-4" action="verifications/verification_inscription.php" method="post" enctype="multipart/form-data">
                <?php include "includes/message.php"; ?>
                <div class="mb-3">
                    <label class="form-label"><strong>Pseudo</strong></label>
                    <input type="text" name="pseudo" class="form-control" value="<?= isset(
                      $_COOKIE["pseudo"]
                    )
                      ? $_COOKIE["pseudo"]
                      : "" ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong> Adresse mail</strong></label>
                    <input type="email" name="email" class="form-control" value="<?= isset(
                      $_COOKIE["email"]
                    )
                      ? $_COOKIE["email"]
                      : "" ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Mot de passe</strong></label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Confirmation du mot de passe</strong></label>
                    <input type="password" name="conf_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Photo de profil</strong></label>
                    <input type="file" name="image" class="form-control" accept="image/png, image/jpeg">
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Date de naissance</strong></label>
                    <input type="date" name="birth" class="form-control" value="<?= isset(
                      $_COOKIE["birth"]
                    )
                      ? $_COOKIE["birth"]
                      : "" ?>" required>
                </div>

            <button type="submit" name="submit" class="btn">Envoyer</button>
            
        </form>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
    <script src="js/darkMode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
