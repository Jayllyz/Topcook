<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../../images/topcook_logo.svg";
$linkCss = "../../css/style.css";
$title = "Modification du profil";
include "../../includes/head.php";
?>
<body>

    <?php include "../../includes/header.php"; ?>
    
    <form action="verif_profile.php" method="post" enctype="multipart/form-data">
        <div class="container col-md-4">
      <input type="text" name="pseudo" class="form-control" placeholder="Modifier votre pseudo"><br>
      <input type="email" name="email" class="form-control" placeholder="Modifier votre email"><br>
      <input type="email" name="email" class="form-control" placeholder="Modifier votre mot de passe"><br>
      <input type="email" name="email" class="form-control" placeholder="Resaissir votre mot de passe" required><br>
      <input type="file" class="form-control" name="image" accept="image/jpeg,image/png"><br>
      <input type="submit" class="btn btn-success" value="Submit">
      </div>
    </form>


    <?php include "../../includes/footer.php"; ?>

    <script src="../../js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>