<?php session_start();

include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "TopCook - Concours";
include "includes/head.php";
if (isset($_SESSION["id"])) {
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

      <?php if ($_SESSION["rights"] == 1) { ?>
           <div class="btn_ingredients mb-4">
                 <a href="contest/createContest.php" class="btn">
                       Créer un concours
                  </a>
             </div>
      <?php } ?>
        <?php

        $selectContest = $db->prepare("SELECT id,name,description,theme,image,date_start,date_end FROM CONTEST WHERE date_end > NOW()");
        $selectContest->execute();
        $resultContest = $selectContest->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultContest as $contest){
            $name = $contest["name"];
            $description = $contest["description"];
            $theme = $contest["theme"];
            $image = $contest["image"];
            $date_start = $contest["date_start"];
            $date_end = $contest["date_end"];
            ?>
        <div class="contest container row d-flex justify-content-center mb-3">
            <div class="col-md-6">
                <img src="https://topcook.site/uploads/img_contest/<?= $image; ?>" alt="<?= $name; ?>" class="img-fluid">
                <h2><?= $name ?></h2>
                <div class="info_contest">
                    <p>Description : <?= $description ?></p>
                    <p>Le thème est <em><?= $theme ?></em></p>
                    <p>A commencer le <em><strong><?= date("d/m/Y", strtotime($date_start)) ?></strong></em></p>
                    <p>Se termine le <em><strong><?= date("d/m/Y", strtotime($date_end)) ?></strong></em></p>
                </div>
            </div>
        </div>

        <?php } ?>

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
<?php include "includes/scripts.php"; ?>
</html>