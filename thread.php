<?php
  require('questions/creerthread.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Topcook - Forum";
include "includes/head.php";?>
<body>
  <?php include 'includes/header.php';?>
  <br><br>
  <form class="container" method="POST">

    <?php
      if(isset($errorMsg))
      {
        echo '<p>' . $errorMsg . '<p>';
      }elseif (isset($successMsg)) {
        echo '<p>' . $successMsg . '</p>';
      }
     ?>

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Titre</label>
      <input type="text" class="form-control" name="title">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Description</label>
      <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Contenu</label>
      <textarea class="form-control" name="contenu"></textarea>
    </div>
    <button type="submit" class="btn" name="bouton">Publier</button>
    <br><br>
    <a href="https://topcook.site/publication.php">Voir les publications</a>
  </form>

  <?php include "includes/footer.php"; ?>
</body>

</html>
