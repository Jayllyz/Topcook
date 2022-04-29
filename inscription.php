<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Inscription";
include "includes/head.php";
if (isset($_SESSION["id"])) {
  $date = date("d/m/Y H:i:s");
  $log_visit = fopen("log/log_inscription.txt", "a+");
  fputs($log_visit, "Visite de inscription le :");
  fputs($log_visit, $date);
  fputs($log_visit, " par ");
  fputs($log_visit, $_SESSION["id"]);
  fputs($log_visit, "\n");
  fclose($log_visit);
}
?>

<body onload="randomCaptcha()">
    <?php include "includes/header.php"; ?>
    <main>
        <h1>Inscription</h1>
        <div class="formulaire">
            <form id="form" class="container col-md-4" action="verifications/verification_inscription.php" method="post" enctype="multipart/form-data">
                <?php include "includes/message.php"; ?>
                <div class="mb-3">
                    <label class="form-label"><strong>Pseudo</strong></label>
                    <input type="text" name="pseudo" class="form-control is-<?= isset(
                      $_GET["valid"]
                    ) && $_GET["input"] == "pseudo"
                      ? $_GET["valid"]
                      : "" ?>" value="<?= isset($_COOKIE["pseudo"])
  ? $_COOKIE["pseudo"]
  : "" ?>" required>
                  <div class="<?= $_GET["valid"] ?>-feedback">
                    <?= $_GET["message"] ?>
                  </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Adresse mail</strong></label>
                    <input type="email" name="email" class="form-control is-<?= isset(
                      $_GET["valid"]
                    ) && $_GET["input"] == "email"
                      ? $_GET["valid"]
                      : "" ?>" value="<?= isset($_COOKIE["email"])
  ? $_COOKIE["email"]
  : "" ?>" required>
                    <div class="<?= $_GET["valid"] ?>-feedback">
                    <?= $_GET["message"] ?>
                  </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Mot de passe</strong></label>
                    <input type="password" name="password" class="form-control is-<?= isset(
                      $_GET["valid"]
                    ) && $_GET["input"] == "mdp"
                      ? $_GET["valid"]
                      : "" ?>" id="password" oninput="strengthChecker()" required>
                    <div id="strength-bar"></div>
                    <p id="msg"></p>
                    <label class="form-label">Voir mon mot de passe</label>
                    <input type="checkbox" class="form-check-input" onClick="viewPasswordInscription()">
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Confirmation du mot de passe</strong></label>
                    <input type="password" name="conf_password" class="form-control" id="conf_Password_inscription" required>
                      <div class="<?= $_GET["valid"] ?>-feedback">
                        <?= $_GET["message"] ?>
                      </div>
                    <label class="form-label">Voir mon mot de passe</label>
                    <input type="checkbox" class="form-check-input" onClick="viewConfPasswordInscription()">
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Photo de profil</strong></label>
                    <input type="file" name="image" class="form-control is-<?= isset(
                      $_GET["valid"]
                    ) && $_GET["input"] == "fichier"
                      ? $_GET["valid"]
                      : "" ?>" accept="image/png, image/jpeg">
                    <div class="<?= $_GET["valid"] ?>-feedback">
                      <?= $_GET["message"] ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Date de naissance</strong></label>
                    <input type="date" name="birth" class="form-control" value="<?= isset(
                      $_COOKIE["birth"]
                    )
                      ? $_COOKIE["birth"]
                      : "" ?>" required>
                </div>
                <button type="button" id="captcha-btn" class="btn btn-captcha me-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Captcha
                </button>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Captcha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="puzzle col-md-8" id="puzzle">
                                    

                                </div>
                                <p id="captcha-message" class="text-center"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div id="validate-captcha"></div>
            <button type="submit" name="submit" id="submit" class="btn btn-success">Envoyer</button>
            
        </form>
        </div>
    </main>
    <?php include "includes/scripts.php"; ?>
    <script src="js/captcha.js"></script>
    <?php include "includes/footer.php"; ?>

</body>
</html>
