<?php
session_start();
include "../../includes/db.php";
$id = htmlspecialchars($_GET["id"]);
if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) { ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../../images/topcook_logo.svg";
$linkCss = "../../css/style.css";
$title = "TopCook - Consultation";
include "../../includes/head.php";
?>
<body>
    <?php include "../../includes/header.php"; ?>
    <?php
    $req = $db->prepare(
      "SELECT pseudo, email, date_birth,rights,image,creation FROM USER WHERE id = :id"
    );
    $req->execute([
      "id" => $id,
    ]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $select) { ?>

    <h1>Profil de <?= $select["pseudo"] ?></h1>
    <div class="container">
        <table class="table text-center table-bordered">
            <tr>
                <th>Photo de profil</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Droits</th>
                <th>Date de création de compte</th>
            </tr>
            <tr>
                <td><?php if (!empty($select["image"])) {
                  echo '<img src="../../uploads/' .
                    $select["image"] .
                    '" class="image-users me-3" alt="..." width="50">';
                } ?></td>
                <td><?= $select["pseudo"] ?></td>
                <td><?= $select["email"] ?></td>
                <td><?= $select["date_birth"] ?></td>
                <td><?= $select["rights"] ?></td>
                <td><?= $select["creation"] ?></td>
                
            </tr>
        </table>
    </div>
    <h1>Historiques des messages</h1>
    <h3 class="text-center"><em>A venir...</em></h3>

    <?php }
    ?>
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
