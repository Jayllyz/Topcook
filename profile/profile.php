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
      "SELECT email,image, date_birth,rights,avatar FROM USER WHERE id = " .
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
<div class="mt-3 mb-3 container">
      <div class="card col-md-4 card_profil">
        <?php if (!empty($select["image"]) && $select["avatar"] === "0") { ?>
          <?php echo '<img src="../uploads/' .
            $select["image"] .
            '" class="card-img-top" id="img_profil" width="400" alt="...">'; ?>
       <?php } ?>
        <?php if (!empty($select["image"]) && $select["avatar"] === "1") {
          echo "<div id='ajax'></div>";
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
        <a href="https://topcook.site/profile/update/form_update.php?id=<?= $_SESSION[
          "id"
        ] ?>" class="btn card-link text-decoration-none text-dark">Modifier votre profil</a>
        <a href="https://topcook.site/avatar/avatar.php" class="btn mt-3 card-link text-decoration-none text-dark">Créé votre avatar</a>
        <button class="btn mt-3 card-link text-decoration-none text-dark" id="avatarButton" onClick="activateAvatar()">Activer</button>
        <a href="https://topcook.site/profile/exportData.php" class="btn mt-3 card-link text-decoration-none text-dark">Exporter vos données</a>
    </div>
  </div>


</div>
<?php }
    ?>
    </main>

    <?php include "../includes/footer.php"; ?>
    <script src="../js/changeAccessories.js"></script>
    <?php include "../includes/scripts.php"; ?>
</body>
</html>
<?php } else {header("location: ../index.php");
  exit();} ?>
