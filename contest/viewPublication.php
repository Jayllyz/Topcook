<?php
session_start();
include "../includes/db.php";
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
            <p class="text-center">Attention votre vote est définitif</p>

            <div class="pb-4 row" id="img-participate">
                <?php
                $selectParticipate = $db->query("SELECT id, idUser, idContest, image, likes FROM PARTICIPATE ORDER BY id ASC");
                $resultParticipate = $selectParticipate->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultParticipate as $participate) {
                    $idParticipate = $participate['id'];
                ?>
                    <div class="col-md-4 m-3 d-flex align-items-center">
                        <img src="../uploads/uploadsParticipate/<?= $participate["image"] ?>" class="img-fluid allrecipes" alt="">
                        <img src="../images/like.svg" class="ms-3" width="30" height="30" alt="like" onclick="likeParticipate(<?= $idParticipate ?>)">
                        <p id="<?= $idParticipate ?>"><?= $participate['likes'] ?></p>
                    </div>


                <?php } ?>
            </div>
        </div>
    </main>
    <?php include "../includes/footer.php"; ?>

    <?php include "../includes/scripts.php"; ?>
    <script src="../js/likeParticipate.js"></script>
</body>

</html>