<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Inscription";
include "includes/head.php";
if(isset($_SESSION["id"])) {
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

<body onload="randomImg()">
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
<div class="d-flex">
                <button type="button" class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                <div class="puzzle col-md-8" id="puzzle" style="margin: 0 auto;">
                                    <img src="images/captcha/minion/1.jpg" id="1" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/2.jpg" id="2" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/3.jpg" id="3" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/4.jpg" id="4" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/5.jpg" id="5" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/6.jpg" id="6" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/7.jpg" id="7" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/8.jpg" id="8" onclick="changeImage(this.src, this.id)">
                                    <img src="images/captcha/minion/9.jpg" id="9" onclick="changeImage(this.src, this.id)">

                                </div>
                                <p id="captcha-message" class="text-center"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>

            <button type="submit" name="submit" id="submit" class="btn">Envoyer</button>
</div>
            
        </form>
        </div>
    </main>
    <script>
        let temp_src = [];
        let temp_id = [];
        let result_images = [];
        let verify_images = [];
        let compteur = 0;
        let submit = document.getElementById("submit");
        let p = document.getElementById("captcha-message");
        submit.style.display = "none";
        function randomImg() {
            let tabid = [];
            for (let i = 1; i <= 9; i++) {
                tabid.push(i);
            }
            tabid.sort(() => Math.random() - 0.5);
            let img;
            let j = 0;
            for (let i = 1; i <= 9; i++) {
                img = document.getElementById(i);
                let idImg = img.id;
                idImg = tabid[j];
                j++;
                img.id = idImg;
            }

            for (let i = 1; i <= 9; i++) {
                img = document.getElementById(i);
                let srcImg = img.src;
                srcImg = tabid[j];
                j++;
                img.src = "images/captcha/minion/" + img.id + ".jpg";
            }

        }
        function verifCaptcha(){
            let count = 0;
            let j = 1;
            let children = document.getElementById("puzzle").children;
            for (let i = 0; i < 9; i++) {
                let img = children[i];
                if (parseInt(img.id) === j) {
                    count++;
                }
                j++;

            }
            if (count === 9) {
                return true;
            }
        }

        function changeImage(src_image, id_image) {
            compteur++;

            temp_src.push(src_image);
            temp_id.push(id_image);
            if (compteur % 2 === 0) {
                let temp_src_1 = temp_src[0];
                let temp_id_1 = temp_id[0];
                let temp_src_2 = temp_src[1];
                let temp_id_2 = temp_id[1];

                temp_src[0] = temp_src_2;
                temp_id[0] = temp_id_2;
                temp_src[1] = temp_src_1;
                temp_id[1] = temp_id_1;

                result_images.push(id_image);
                verify_images.push(temp_id[0]);

                let image_1 = document.getElementById(temp_id[0]);
                let image_2 = document.getElementById(temp_id[1]);
                image_1.src = temp_src[1];
                image_1.id = temp_id[1];
                image_2.src = temp_src[0];
                image_2.id = temp_id[0];

                temp_src = [];
                temp_id = [];
                if(verifCaptcha() === true){
                    submit.style.display = "block";
                    p.innerHTML = "Validé"
                }
            }
        }

    </script>
    <?php include "includes/footer.php"; ?>
    <?php
    $linkJSGeneral = "js/app.js";
    $linkJSSearch = "js/search.js";
    include "includes/scripts.php";
    ?>
</body>
</html>
