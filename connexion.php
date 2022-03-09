<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Connexion";
include "includes/head.php";
?>
<body>
    <?php include "includes/header.php"; ?>
    <main>
        
        <form>
            <div class="container col-4">
                <div class="mb-3">
                    <label for="login" class="form-label">Pseudo ou Email</label>
                    <input type="text" class="form-control" name="login">
                </div>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password">
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" name="checkbox">
                    <label for="stay-connected">Rester connecter</label>
                </div>
                <button type="submit" class="btn">Envoyé</button>
            </div>
        </form>
          
    </main>
    <?php include "includes/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>