<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Inscription";
include "includes/head.php";
?>

<body>
    <?php include "includes/header.php"; ?>
    <main>
            <form class="container col-md-4" action="verification_inscription.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmation du mot de passe</label>
                    <input type="password" name="conf_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photos de profil</label>
                    <input type="file" name="image" class="form-control" accept="image/png, image/jpeg">
                </div>
                <div class="mb-3">
                    <label class="form-label">Votre date de naissance</label>
                    <input type="date" name="birth" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    
                    <label class="form-check-label">Se souvenir de moi
                        <input type="checkbox" class="form-check-input">
                    </label>
                </div>
            <button type="submit" name="submit" class="btn">Submit</button>
            
        </form>
        <?php include('includes/message.php'); ?>
    </main>
    <?php include "includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
