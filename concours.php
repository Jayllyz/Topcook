<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "TopCook - Concours";
include "includes/head.php";
if(isset($_SESSION["id"])) {
  $date = date("d/m/Y H:i:s");
  $log_visit = fopen("log/log_concours.txt", "a+");
  fputs($log_visit, "Visite de concours le :");
  fputs($log_visit, $date);
  fputs($log_visit, " par ");
  fputs($log_visit, $_SESSION["id"]);
  fputs($log_visit, "\n");
  fclose($log_visit);
}
?>
<body>
    <?php include "includes/header.php"; ?>
    <main>
      <div class="container col-md-6">
      <?php include "includes/message.php"; ?>
      </div>
      <h1 class="pb-3 text-center"><strong>Concours</strong></h1>

      <div class=" justify-content-center competition pb-5">
        <a href=""><img src="https://braindegeek.com/wp-content/uploads/2016/11/concours.png"  class="img-fluid" ></a>
      </div>

      <form method="post" action="">
          <div class="container col-md-4">
            <label class="control-label"><strong>Votre photo pour participer</strong></label>
            <input type="file" class="form-control" name="image" accept="image/jpeg,image/png"><br>
            <input type="submit" class="btn btn-success" value="Submit">
        </div>
      </form>
    </main>
</body>
<?php include "includes/footer.php"; ?>
    
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>