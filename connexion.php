<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Connexion";
include "includes/head.php";
if(isset($_SESSION["id"])) {
    $date = date("d/m/Y H:i:s");
    $log_visit = fopen("log/log_connexion.txt", "a+");
    fputs($log_visit, "Visite de connexion le :");
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
        <h1>Connexion</h1>
        <div class="container col-md-6">
            <?php include "includes/message.php"; ?>
        </div>
        <form name="connexion" onsubmit="return validateForm(this.name)" action="verifications/verification_connexion.php" method="post">
            <div class="container col-md-4" id="form" >
                <div class="mb-3">
                    <label for="login" class="form-label"><strong>Email</strong></label>
                    <input type="email" class="form-control" name="login" value="<?= isset(
                      $_COOKIE["email"]
                    )
                      ? $_COOKIE["email"]
                      : "" ?>" required>
                </div>
                    <label for="password" class="form-label"><strong>Mot de passe</strong></label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    <label class="form-label">Voir mon mot de passe</label>
                    <input type="checkbox" class="form-check-input" onClick="viewPassword()">
                <div class="mb-3">
                    <label for="stay-connected">Rester connecté</label>
                    <input type="checkbox" class="form-check-input" name="checkbox">
                </div>
                <div class="mb-3">
                <a href="lost_password.php">Mot de passe oublié ?</a>
                </div>
                <button type="submit" name="submit" class="btn">Envoyer</button>
            </div>
        </form>
          
    </main>
    <?php include "includes/footer.php"; ?>
    <?php
    include "includes/scripts.php";
    ?>
</body>
</html>