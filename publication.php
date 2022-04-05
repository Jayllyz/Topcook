<?php
require('questions/publicationaction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>
<body>
  <?php include 'includes/header.php'; ?>

  <br><br>
  <div class="container">
  <?php

    while($question = $getAllMyQuestions->fetch()){
      ?>
      <div class="card">
        <div class="card-header">
          <?php echo $question['titre'] ?>
        </div>
        <div class="card-body">
          <p class="card-text"><?php echo $question['description'] ?></p>
          <a href="#" class="btn btn-primary">accéder a la publication</a>
       </div>
      </div>
      <br><br>
      <?php
    }

   ?>
 </div>
</body>
<?php include "includes/footer.php";?>
</html>
