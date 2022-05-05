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
        <?php
        $req = $db->query("SELECT id FROM CONTEST");
        $nb_contest = $req->rowCount();
        ?>
        <?php if ($_SESSION["rights"] == 1 && $nb_contest == 0) { ?>
            <div class="btn_ingredients mb-4">
                <a href="contest/createContest.php" class="btn">
                    Créer un concours
                </a>
            </div>
        <?php } ?>


        <?php

        $selectContest = $db->prepare("SELECT id,name,description,theme,image,date_start,date_end FROM CONTEST");
        $selectContest->execute();
        $resultContest = $selectContest->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultContest as $contest) {
            $id = $contest["id"];
            $name = $contest["name"];
            $description = $contest["description"];
            $theme = $contest["theme"];
            $image = $contest["image"];
            $date_start = $contest["date_start"];
            $date_end = $contest["date_end"];
        ?>
            <div class="timer" id="info_timer">
                <p class="fs-3 end_contest" id="end-contest">Le concours se termine dans: </p>
                <div id="timer">

                    <input type="hidden" id="date" value="<?= $date_end ?>">
                    <div class="days"><span id="days"></span>
                        <p>Jours</p>
                    </div>
                    <div class="hours"><span id="hours"></span>
                        <p>Heures</p>
                    </div>
                    <div class="minutes"><span id="minutes"></span>
                        <p>Minutes</p>
                    </div>
                    <div class="seconds"><span id="seconds"></span>
                        <p>Secondes</p>
                    </div>
                </div>
            </div>
            <div class="contest container row d-flex justify-content-center mb-3">
                <div class="col-md-6">
                    <img src="https://topcook.site/uploads/img_contest/<?= $image; ?>" alt="<?= $name; ?>" class="img-fluid">
                    <h2><?= $name ?></h2>
                    <div class="info_contest">
                        <p>Description : <?= $description ?></p>
                        <p>Le thème est <em><?= $theme ?></em></p>
                        <p>Début le <em><strong><?= date("d/m/Y", strtotime($date_start)) ?></strong></em></p>
                        <p>Fin le <em><strong><?= date("d/m/Y", strtotime($date_end)) ?></strong></em></p>
                    </div>
                </div>
            </div>
            <?php

            $date_end = strtotime($date_end);
            $now = time();
            $diff = $date_end - $now;

            if ($diff > 0) {
            ?>
                <form method="post" action="verifications/verifications_contest/participation.php?id=<?= $id ?>" id="form_contest" enctype="multipart/form-data">

                    <div class="container col-md-4">
                        <label class="control-label"><strong>Votre photo pour participer</strong></label>
                        <input type="file" class="form-control" name="image" accept="image/jpeg,image/png"><br>
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>
            <?php } else { ?>
                <div class="container col-md-4" id="div-voted">
                    <a class="btn" id="btn-voted" href="https://topcook.site/contest/viewPublication.php">Place aux votes</a>
                </div>
        <?php }
        } ?>
    </main>

    <?php include "includes/footer.php"; ?>
    <script src="js/timer.js"></script>
    <script src="js/likeParticipate.js"></script>
    <?php include "includes/scripts.php"; ?>
</body>

</html>