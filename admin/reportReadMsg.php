<?php
session_start();
include "../includes/functions.php";
include "../includes/db.php";
if (!isset($_SESSION["id"]) && $_SESSION["rights"] != 1) {
  header("Location: https://topcook.site/");
  exit();
}
?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Signalements messages";
include "../includes/head.php";
?>

<body>
  <?php include "../includes/header.php"; ?>
  <main id="swup" class="transition-fade">
    <h1 class="pb-3">Liste des signalements des messages</h1>
    <div class="container">
      <div id="logs">
        <a href="https://topcook.site/admin/reportReadCom" class="btn mb-4 comment_report">Commentaires signalés</a>
        <a href="https://topcook.site/admin/reportRead" class="btn ms-4 mb-4 recipe_report">Recettes signalés</a>

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
          "SELECT id_msg, count(id_msg) FROM FORUM_MSG_REPORT GROUP BY id_msg"
        );
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $select) { ?>

          <?php
          $getName = $db->prepare(
            "SELECT id_user FROM FORUM_MSG WHERE id = :id_msg"
          );
          $getName->execute([
            "id_msg" => $select["id_msg"],
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
              <td><?= $select["count(id_msg)"] ?><p><a href="https://topcook.site/admin/viewMsgReport.php?id_msg=<?= $select['id_msg'] ?>&pseudo=<?= $resultUser['pseudo'] ?>">Consulter les messages</a></p>
              </td>
              <td>
                <div class="button_profil">
                  <a href="users/read.php?id=<?= $resultName["id_user"] ?>" class="btn-read btn ms-3 me-3">Consulter</a><br>

                  <a href="users/ban.php?id=<?= $resultName["id_user"] ?>&pseudo=<?= $resultUser["pseudo"] ?>&rights=<?= $resultUser["rights"] ?>" class="btn btn-ban ms-3 me-3">Bannir</a>

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