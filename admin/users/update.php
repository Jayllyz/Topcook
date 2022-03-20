<?php session_start();
if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) { ?>
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$pseudo = $_GET["pseudo"];
$linkLogoOnglet = "../../images/topcook_logo.svg";
$linkCss = "../../css/style.css";
$title = "Modification de $pseudo";
include "../../includes/head.php";
?>
<body>

<?php include "../../includes/header.php"; ?>
    <form action="verif/verif_update.php" method="post">
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

<?php include "../../includes/footer.php"; ?>

<script src="../../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php } else {header("location: http://164.132.229.157/");
  exit();} ?>
