<?php
include "db.php";
$req = $db->prepare("SELECT token FROM USER WHERE email = :email");
$req->execute([
  "email" => $_GET["email"],
]);
$result = $req->fetch(PDO::FETCH_ASSOC);
foreach ($result as $existToken) {
  if ($existToken != "") { ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Modification du mot de passe";
include "../includes/head.php";
?>
<body>
    <?php
    include "../includes/header.php";
    $email = $_GET["email"];
    $token = $_GET["token"];
    ?>

    <form action="../verifications/change_password_script.php?email=<?= $email ?>&token=<?= $token ?>" method="post">
    <div class="container col-md-6">
            <?php include "message.php"; ?>
        </div>
            <div class="container col-md-4" id="form" >
                <div class="mb-3">
                    <label for="login" class="form-label"><strong>Mot de passe</strong></label>
                    <input type="password" class="form-control" name="password">
                    <label for="login" class="form-label"><strong>Retaper votre mot de passe</strong></label>
                    <input type="password" class="form-control" name="confPassword"><br>
                    <button type="submit" name="submit" class="btn">Envoyer</button>
                </div>
            </div>
    </form>


    <?php include "../includes/footer.php"; ?>
</body>
</html>
<?php } else {header(
      "location: ../index.php?message=Le liens à expiré !&type=danger"
    );
    exit();}
} ?>
