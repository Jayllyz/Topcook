<?php session_start();
$id_user = $_GET['id'];
if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) { ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$pseudo = htmlspecialchars($_GET["pseudo"]);
$linkLogoOnglet = "../../images/topcook_logo.svg";
$linkCss = "../../css/style.css";
$title = "Modification de $pseudo";
include "../../includes/head.php";
?>
<body>

<?php include "../../includes/header.php"; ?>
<main id="swup" class="transition-fade">
    <form action="verif/verif_update.php?id=<?=$id_user?>" method="post">
        <div class="container col-md-6">
            <?php include "../../includes/message.php"; ?>
        </div>
        <div class="container col-md-4" id="form" >
            <div class="mb-3">
                <label class="form-label"><strong>Email</strong></label>
                <input type="email" class="form-control" name="email">
                <label class="form-label mt-3"><strong>Pseudo</strong></label>
                <input type="text" class="form-control" name="pseudo">
                <label class="form-label mt-3"><strong>Droits</strong></label>
                <input type="number" class="form-control" name="rights">
                <button type="submit" name="submit" class="btn mt-3">Envoyer</button>
            </div>
        </div>
    </form>
</main>
<?php include "../../includes/footer.php"; ?>
<?php
$linkJSGeneral = "../../js/app.js";
$linkJSSearch = "../../js/search.js";
include "../../includes/scripts.php";
?>
</body>
</html>
<?php } else {header("location: http://164.132.229.157/");
  exit();} ?>
