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
        <div class="container g-1" id="recettes">
            <h1>Vote du concours</h1>

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
                                    <img src="../images/like.svg" id="<?= $idParticipate ?>" alt="like" width="30" class="<?= $idUserIfLike ==
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
                            <p class="ps-3 fs-4 result_like" id="<?= $idParticipate ."-like"?> "><?= $resultLike ?></p>

                        </div>
                        <div id="error_like"></div>

                    </div>


                <?php } ?>
            </div>
        </div>
    </main>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/likes.js"></script>
    <?php include "../includes/scripts.php"; ?>
    <script src="../js/likeParticipate.js"></script>

</body>

</html>