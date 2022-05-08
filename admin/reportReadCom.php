<?php
session_start();
include "../includes/functions.php";
include "../includes/db.php";
if(!isset($_SESSION["id"]) && $_SESSION["rights"] != 1) {
    header("Location: https://topcook.site/");
    exit();
}
?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Signalements commentaires";
include "../includes/head.php";
?>

<body>
  <?php include "../includes/header.php"; ?>
  <main id="swup" class="transition-fade">
    <h1 class="pb-3">Liste des signalements des commentaires</h1>
    <div class="container">
      <div id="logs">
        <a href="https://topcook.site/admin/reportRead" class="btn mb-4 recipe_report">Recettes signalés</a>
        <a href="https://topcook.site/admin/reportReadMsg" class="btn ms-4 mb-4 msg_report">Messages signalés</a>

      </div>
      <table class="table text-center table-bordered table-hover" id="active">
        <thead>
          <tr>
            <th>Pseudo</th>
            <th>Nombre de signalements</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php
        $query = $db->query(
          "SELECT id_comment, count(id_comment) FROM REPORT_COM GROUP BY id_comment"
        );
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $select) { ?>

          <?php
          $getName = $db->prepare(
            "SELECT id_user FROM COMMENTAIRE WHERE id = :id_comment"
          );
          $getName->execute([
            "id_comment" => $select["id_comment"],
          ]);
          $resultName = $getName->fetch(PDO::FETCH_ASSOC);

          $getUser = $db->prepare(
            "SELECT pseudo, rights  FROM USER WHERE id = :id_user"
          );
          $getUser->execute([
            "id_user" => $resultName["id_user"],
          ]);
          $resultUser = $getUser->fetch(PDO::FETCH_ASSOC);
          ?>
          <tbody>
            <tr>
              <td><?= $resultUser["pseudo"] ?></td>
              <td><?= $select["count(id_comment)"] ?></td>
              <td>
                <div class="button_profil">
                  <a href="users/read.php?id=<?= $resultName["id_user"] ?>" class="btn-read btn ms-3 me-3">Consulter</a><br>

                  <a href="users/ban.php?id=<?= $resultName["id_user"] ?>&pseudo=<?= $resultUser["pseudo"] ?>&rights=<?= $resultUser["rights"] ?>" class="btn btn-danger btn-ban ms-3 me-3">Bannir</a>

                </div>
              </td>
            </tr>
          </tbody>

        <?php }
        ?>
      </table>
    </div>
  </main>
  <script src="https://topcook.site/node_modules/swup/dist/swup.min.js"></script>
  <script src="https://topcook.site/js/swup.js"></script>
  <?php include "../includes/footer.php"; ?>
  <?php include "../includes/scripts.php"; ?>
</body>

</html>