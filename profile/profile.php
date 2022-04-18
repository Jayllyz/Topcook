<?php
session_start();
include "../includes/db.php";
$id = $_SESSION["id"];
if (isset($id)) { ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Mon profil";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>

    <main>

    <h2 class="text-center text-uppercase">Bienvenue sur votre profil <?= $pseudo ?> !</h2>
    <?php
    $req = $db->query(
      "SELECT email,image, date_birth,rights FROM USER WHERE id = " .
        $_SESSION["id"]
    );
    $req->execute([
      "id" => $id,
    ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $select) { ?>
        <div class="container col-md-6">
            <?php include "../includes/message.php"; ?>
        </div>
<div class="mt-3 mb-3 container col-md-4">
      <div class="card card_profil">
        <?php if (!empty($select["image"])) {
          echo '<img src="../uploads/' .
            $select["image"] .
            '" class="card-img-top" id="img_profil" alt="...">';
        } ?>
        <div class="card-body">
          <h5 class="card-title text-uppercase text-center"><?= $pseudo ?></h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Votre email: </strong><?= $select[
            "email"
          ] ?></li>
          <li class="list-group-item"><strong>Votre aniverssaire: </strong><?= $select[
            "date_birth"
          ] ?></li>
        </ul>
        <div class="card-body button_profil">
        <button type="button" class="btn"><a href="https://topcook.site/profile/update/form_update.php?id=<?= $_SESSION[
          "id"
        ] ?>" class="card-link text-decoration-none text-dark">Modifier votre profil</a></button>
        <button type="button" class="btn mt-3"><a href="#" class="card-link text-decoration-none text-dark">Créé votre avatar</a></button>
    </div>
  </div>


</div>
<?php }
    ?>
    </main>

    <?php include "../includes/footer.php"; ?>

    <?php
    $linkJSGeneral = "../js/app.js";
    $linkJSSearch = "../js/search.js";
    include "../includes/scripts.php";
    ?>
</body>
</html>
<?php } else {header("location: ../index.php");
  exit();} ?>
