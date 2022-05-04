<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Concours";
include "../includes/head.php";
if (isset($_SESSION["id"])) {
  $date = date("d/m/Y H:i:s");
  $log_visit = fopen("../log/log_concours.txt", "a+");
  fputs($log_visit, "Visite de concours le :");
  fputs($log_visit, $date);
  fputs($log_visit, " par ");
  fputs($log_visit, $_SESSION["id"]);
  fputs($log_visit, "\n");
  fclose($log_visit);
}
?>
<body>
    <?php include "../includes/header.php"; ?>
        <div class="container col-md-6">
            <?php include "../includes/message.php"; ?>
        </div>
    <main>
            <form name="contest" onsubmit="return validateForm(this.name);"method="post" action="../verifications/verifications_contest/add_contest.php" enctype="multipart/form-data">             
                <div class="container col-md-4">
                    <label class="control-label"><strong>Titre du concours</strong></label>
                    <input type="text" class="form-control" name="title"  required><br>

                    <label class="control-label"><strong>Régles du concours</strong></label>
                    <textarea class="form-control" name="rules"  required></textarea><br>

                    <label class="control-label"><strong>Date de début</strong></label>
                    <input type="date" class="form-control" name="start_date" required><br>

                    <label class="control-label"><strong>Date de fin</strong></label>
                    <input type="date" class="form-control" name="end_date" required><br>

                    <label class="control-label"><strong>Thèmes</strong></label>
                    <select name="theme" class="form-control" required>
                        <option value="0">Choisissez un thème</option>
                        <option value="entrée">Entrée</option>
                        <option value="plat">Plat</option>
                        <option value="dessert">Dessert</option>
                    </select><br>
                    <label class="control-label"><strong>Photo du concours</strong></label>
                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/png"><br>

                    <input type="submit" class="btn btn-success" value="Submit">
                </div>

    </main>

    <?php include "../includes/footer.php"; ?>
    <?php include "../includes/scripts.php"; ?>
</body>
</html>