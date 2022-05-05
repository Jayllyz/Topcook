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
  <main>
    <div class="container col-md-6">
      <?php include "../../includes/message.php"; ?>
    </div>
    <form action="update.php?id=<?= $_SESSION["id"] ?>" method="post" enctype="multipart/form-data">
      <div class="container col-md-4">
        <input type="text" name="pseudo" class="form-control" placeholder="Modifier votre pseudo"><br>
        <input type="email" name="email" class="form-control" placeholder="Modifier votre email"><br>
        <input type="password" name="password" class="form-control" placeholder="Modifier votre mot de passe"><br>
        <input type="password" name="password_confirm" class="form-control" placeholder="Resaissir votre mot de passe"><br>
        <input type="file" class="form-control" name="image" accept="image/jpeg,image/png"><br>
        <input type="submit" name="submit" class="btn btn-success" value="Submit">
      </div>
    </form>

  </main>
  <?php include "../../includes/footer.php"; ?>

  <?php
  include "../../includes/scripts.php";
  ?>
</body>

</html>