<?php
session_start();
include "../includes/db.php";
if (isset($_SESSION["id"])) { ?>
    <!DOCTYPE html>
    <html lang="fr">
    <?php
    $linkLogoOnglet = "../images/topcook_logo.svg";
    $linkCss = "../css/style.css";
    $title = "Ajouter un topic";
    include "../includes/head.php";
    ?>

    <body>
        <?php include "../includes/header.php"; ?>
        <main>

            <div class="container col-md-6">
                <?php include "../includes/message.php"; ?>
            </div>
            <h1 class="pb-3 text-center"><strong>Ajouter un topic</strong></h1>

            <form name="add_topic" onsubmit="return validateForm(this.name)" action="../verifications/verifications_forum/verif_topic.php?id=<?= $_SESSION["id"] ?>" method="post" enctype="multipart/form-data"">
        <div class=" container col-md-10 new-topic">
                <label class="form-label">Sujet</label>
                <input class="form-control mb-4" type="text" onkeyup="checkInputLength(this , 20);" name="subject" required>
                <p id="charNum"></p>

                <label class="form-label">Message</label>
                <textarea class="form-control mt-4 mb-4" name="message" required></textarea>

                <label class="form-label mb-4">Image</label>
                <input type="file" class="form-control image-topic mb-4" name="image" id="image">

                <input type="submit" class="form-control btn-success submit mb-4" value="Envoyer">
                </div>
            </form>
        </main>
        <?php include "../includes/footer.php"; ?>

        <?php
        include "../includes/scripts.php";
        ?>
    </body>

    </html>


<?php } else {
    header(
        "Location: topic.php?message=Vous devez être connecté !&type=danger"
    );
    exit();
}
?>