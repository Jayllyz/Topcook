<?php
  require('questions/creerthread.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include "includes/head.php";?>
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
    <button type="submit" class="btn btn-primary" name="bouton">Publier</button>
    <br><br>
    <a href="publication.php"><p>Voir les publications</p></a>
  </form>
</body>
<?php include "includes/footer.php"; ?>
</html>
