<?php
session_start();
include "../includes/db.php";
ini_set("display_errors", 1);
?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Votez pour vos recettes favorites !";
include "../includes/head.php";

?>

<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <?php

        $selectContest = $db->query("SELECT id,name,description,theme,image,date_start,date_end FROM CONTEST");
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
            <div class="container g-1" id="recettes">
                <div class="timer" id="info_timer">
                    <p class="fs-3 end_contest" id="end-contest">Les votes se termine dans: </p>
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
            <?php }
            ?>
            <h1>Vote du concours</h1>
            <div id="end-votes">
                <?php

                $selectIdWinner = $db->query("SELECT id_proposal,  votes, count(votes) AS OCC FROM LIKES_CONTEST GROUP BY votes ORDER BY OCC DESC LIMIT 1");
                $resultIdWinner = $selectIdWinner->fetch(PDO::FETCH_ASSOC);
                $IdWinner = $resultIdWinner["id_proposal"];
                $likes = $resultIdWinner["OCC"];
                if ($resultIdWinner != null) {
                    $selectWinner = $db->query("SELECT pseudo, imageContest FROM USER WHERE id = $IdWinner");
                    $result = $selectWinner->fetch(PDO::FETCH_ASSOC);
                    $winnerPseudo = $result["pseudo"];
                    $winnerImage = $result["imageContest"];
                ?>
                    <h2>Le gagnant est : <?= $winnerPseudo ?> avec <?= $likes ?> likes</h2>
                    <img src="../uploads/uploadsParticipate/<?= $winnerImage ?>" id="img-winner" alt="<?= $winnerPseudo ?>">
                <?php } else { ?>
                    <h2>Aucun gagnant</h2>
                <?php } ?>


            </div>
            <div class="pb-4 row" id="img-participate">
                <?php
                $selectParticipate = $db->query("SELECT id , idContest, imageContest FROM USER  WHERE imageContest != 'NULL' ORDER BY id ASC");
                $resultParticipate = $selectParticipate->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultParticipate as $participate) {
                    $idParticipate = $participate['id'];
                    $idContest = $participate['idContest'];
                ?>
                    <div class="col-md-4 m-3 d-flex align-items-center">
                        <img src="../uploads/uploadsParticipate/<?= $participate["imageContest"] ?>" class="img-fluid allrecipes" alt="">
                        <div class="d-flex flex-row">
                            <div id="like">
                                <?php if (isset($_SESSION["id"])) {

                                    $selectIdUserIfLike = $db->prepare(
                                        "SELECT id_user FROM LIKES_CONTEST WHERE id_user = :id_user AND id_contest = :id_contest AND id_proposal = :id_proposal"
                                    );
                                    $selectIdUserIfLike->execute([
                                        "id_user" => $_SESSION["id"],
                                        "id_contest" => $idContest,
                                        "id_proposal" => $idParticipate
                                    ]);
                                    $idUserIfLike = $selectIdUserIfLike->fetch(
                                        PDO::FETCH_ASSOC
                                    );
                                    $idUserIfLike["id_user"] = $idUserIfLike["id_user"] ?? "";
                                    $idUserIfLike = $idUserIfLike["id_user"];
                                ?>
                                    <img src="../images/like.svg" id="<?= $idParticipate ?>" alt="like" width="30" class="ms-3 <?= $idUserIfLike ==
                                                                                                                                    $_SESSION["id"]
                                                                                                                                    ? "liked"
                                                                                                                                    : "" ?>" height="30" onclick="likeContest(this.id)">
                                <?php
                                } else {
                                ?>
                                    <img src="../images/like.svg" alt="like" width="30" class="notLiked" height="30" onclick="errorLike()">
                                <?php
                                } ?>
                            </div>
                            <?php
                            $selectLike = $db->prepare(
                                "SELECT votes as nbVotes FROM LIKES_CONTEST WHERE id_proposal = :id_proposal"
                            );
                            $selectLike->execute([
                                "id_proposal" => $idParticipate
                            ]);
                            $resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
                            ?>
                            <p class="ps-3 fs-4 result_like" id="<?= $idParticipate . "-like" ?> "><?= $resultLike ?></p>

                        </div>
                        <div id="error_like"></div>

                    </div>


                <?php } ?>
            </div>
            </div>
    </main>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/timerParticipate.js"></script>
    <script src="../js/likes.js"></script>
    <?php include "../includes/scripts.php"; ?>

</body>

</html>