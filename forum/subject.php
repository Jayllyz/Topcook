<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
include "../includes/functions.php";
$id_subject = htmlspecialchars($_GET["id_subject"]);
$pseudo = htmlspecialchars($_GET["creator"]);
$id_creator = htmlspecialchars($_GET["id_creator"]);

$selectTopic = $db->query(
  "SELECT subject, message, image, date FROM TOPIC WHERE id = " . $id_subject
);
$resultTopic = $selectTopic->fetch(PDO::FETCH_ASSOC);
$subject = $resultTopic["subject"];
$message = $resultTopic["message"];
$image = $resultTopic["image"];
$date = $resultTopic["date"];
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = $subject;
include "../includes/head.php";
?>

<body>
  <?php include "../includes/header.php"; ?>
  <main>
    <div class="container col-md-6">
      <?php include "../includes/message.php"; ?>
    </div>
    <h1 class="pb-3 text-center"><strong>Forum</strong></h1>

    <div class="container col-md-10">

      <div class="info_creator text-center">
        <h2 class="pb-3">Sujet : <strong><?= $subject ?></strong></h2>
        <?php if (isset($image) && $image != null) { ?>
          <img src="https://topcook.site/uploads/img_topic/<?= $image ?>" alt="<?= $subject ?>" class="pb-3 img-fluid">
        <?php } ?>
        <p>Créé par : <strong><?= $pseudo ?></strong></p>
        <p>Date de création : <strong><?= $date ?></strong></p>
        <div class="description d-flex justify-content-center">
          <span class="d-flex">Description :<p class="ms-3 me-3" id="description"></span>

          <strong id="message"><?= $message ?></strong>
          <?php if (
            $id_creator == $_SESSION["id"] ||
            $_SESSION["rights"] == 1
          ) { ?>
            <div class="modify">
              <img src="../images/crayon.png" id="crayon" width="30" height="30" alt="modify" class="modify">
            </div>
          <?php } ?>
          </p>
        </div>

        <?php
        $selectReport = $db->prepare(
          "SELECT count(id) FROM REPORT_TOPIC WHERE id_user = :id_user AND id_topic = :id_topic"
        );
        $selectReport->execute([
          "id_user" => $_SESSION["id"],
          "id_topic" => $id_subject,
        ]);
        $selectReport = $selectReport->fetch(PDO::FETCH_NUM);

        if (isset($_SESSION["id"]) && $selectReport[0] == 0) { ?>
          <div class="btn_ingredients mb-4">
            <a href="reportTopic.php?id_topic=<?= $id_subject ?>&creator_name=<?= $pseudo ?>&id_creator=<?= $id_creator ?>" onclick="return checkConfirm('Voulez vous vraiment signaler ce sujet?')" class="btn btn-danger">
              Signaler le topic
            </a>
          </div>
        <?php }
        ?>

      </div>

      <div class="commentaires">

        <form name="add_msg" onsubmit="return validateForm(this.name)" action="../verifications/verifications_forum/verif_message.php?id_topic=<?= $id_subject ?>" method="post">
          <label class="form-label">Saisir un message</label>
          <textarea name="message" class="form-control mb-3" id="comment"></textarea>
          <input type="submit" class="form-control btn btn-success mb-3" name="submit" value="Envoyer">
        </form>
      </div>
      <div class="messages mt-5 mb-5">
        <table class="table text-center table-bordered table-hover">
          <thead>
            <?php
            $selectUserCreateMsg = $db->prepare(
              "SELECT count(id) FROM FORUM_MSG WHERE id_user = :id AND id_topic = :id_topic"
            );
            $selectUserCreateMsg->execute([
              "id" => $_SESSION["id"],
              "id_topic" => $id_subject,
            ]);
            $resultUserCreateMsg = $selectUserCreateMsg->fetch(
              PDO::FETCH_ASSOC
            );
            ?>
            <tr>
              <th>Pseudo</th>
              <th>Message</th>
              <th>Date</th>
              <?php if (isset($_SESSION["id"])) { ?>
                <th id="th-report">Signaler</th>
              <?php } ?>
              <?php if (
                $_SESSION["rights"] == 1 ||
                $_SESSION["id"] == $id_creator ||
                $resultUserCreateMsg > 0
              ) { ?>
                <th>Supprimer</th>
              <?php } ?>
            </tr>
          </thead>
          <?php
          $query = $db->prepare(
            "SELECT id, message, id_topic, id_user, date FROM FORUM_MSG WHERE id_topic = :id_topic ORDER BY date DESC"
          );
          $query->execute([
            "id_topic" => $id_subject,
          ]);
          $selectMessages = $query->fetchAll(PDO::FETCH_ASSOC);
          foreach ($selectMessages as $message) { ?>

            <?php
            $selectReportMsg = $db->prepare(
              "SELECT count(id) FROM FORUM_MSG_REPORT WHERE id_user = :id_user AND id_msg = :id_msg"
            );
            $selectReportMsg->execute([
              "id_user" => $_SESSION["id"],
              "id_msg" => $message["id"],
            ]);
            $selectReportMsg = $selectReportMsg->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="sending">
              <div class="users">
                <?php
                $query = $db->prepare(
                  "SELECT pseudo FROM USER WHERE id = :id_user"
                );
                $query->execute([
                  "id_user" => $message["id_user"],
                ]);
                $selectUser = $query->fetch(PDO::FETCH_ASSOC);
                ?>

                <tbody>
                  <tr>
                    <?php if (
                      $_SESSION["id"] == $message["id_user"]
                    ) { ?>
                      <td>Vous</td>
                    <?php } else { ?>
                      <td><?= $selectUser["pseudo"] ?></td>
                    <?php } ?>
                    <td><?= $test = banword(
                          "../banlist.txt",
                          $message['message'],
                          $db,
                          0
                        );
                        ?></td>
                    <td id="date_send"><?= $message["date"] ?></td>

                    <?php if (
                      isset($_SESSION["id"]) &&
                      isset($selectReportMsg[0]) &&
                    $selectReportMsg[0] == 0 &&
                      $_SESSION["id"] !==
                      $message["id_user"]
                    ) { ?>

                      <td id="th-report">
                        <a href="reportMsg.php?creator=<?= $pseudo ?>&id_msg=<?= $message["id"] ?>&id_subject=<?= $id_subject ?>&id_topic=<?= $id_topic ?>&id_creator=<?= $id_creator ?>" class="btn btn-danger">Signaler</a>

                      </td>
                      <?php } else {
                      if ($_SESSION["id"]) { ?>
                        <td>
                          <a href="#"></a>
                        </td>
                    <?php }
                    } ?>


                    <?php if (
                      $_SESSION["rights"] == 1 ||
                      $_SESSION["id"] == $message["id_user"]
                    ) { ?>
                      <td><a href="../admin/comment/delete_topic_msg.php?id_creator=<?= $id_creator ?>&creator=<?= $pseudo ?>&id_msg=<?= $message["id"] ?>&id_topic=<?= $id_subject ?>&id_subject=<?= $id_subject ?>" class="btn btn-ban">Supprimer</a></td>
                    <?php } ?>
                  </tr>
                </tbody>
              </div>
            </div>
          <?php }
          ?>
        </table>
      </div>
  </main>
  <script>
    const reportBtn = document.getElementById("report-btn");
    let table = document.getElementById("com").rows;
    if (typeof reportBtn === 'undefined' || reportBtn === null) {
      let i = 3;
      for (let j = 0; j < table.length; j++) {
        table[j].deleteCell(i);
      }
    }
  </script>
  <?php include "../includes/footer.php"; ?>
  <?php include "../includes/scripts.php"; ?>
</body>

</html>