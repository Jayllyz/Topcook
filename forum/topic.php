<?php
session_start();
include "../includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Forum";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <div class="container col-md-6">
         <?php include "../includes/message.php"; ?>
        </div>
            <h1 class="pb-3 text-center"><strong>Forum</strong></h1>

            <?php if (isset($_SESSION["id"])) { ?>
              <div class="add-topic">
                  <a class="btn" href="add_topic.php">
                      Ajouter un topic
                  </a>
              </div>

            <?php } ?>

            <?php
            $selectTopic = $db->query(
              "SELECT id, subject, message, image, id_user, date FROM TOPIC ORDER BY id DESC"
            );

            $resultTopic = $selectTopic->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="container col-md-10">
            <table class="table text-center table-bordered table-hover" id="active">
                <thead>
                <tr>
                    <th>Créateur</th>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
                </thead>
            <?php foreach ($resultTopic as $topic) {

              $id_subject = $topic["id"];
              $subject = $topic["subject"];
              $message = $topic["message"];
              $image = $topic["image"];
              $id_user = $topic["id_user"];
              $date = $topic["date"];

              $selectUser = $db->query(
                "SELECT pseudo FROM USER WHERE id = " . $id_user
              );
              $resultUser = $selectUser->fetch(PDO::FETCH_ASSOC);
              $pseudo = $resultUser["pseudo"];
              ?>


                <tbody>
                    <tr>
                        <td><?= $pseudo ?></td>
                        <td><a href="subject.php?id_subject=<?= $id_subject ?>&creator=<?= $pseudo ?>&id_creator=<?=$id_user?>"><?= $subject ?></a></td>
                        <td><?= $message ?></td>
                        <td><?= $date ?></td>
                    </tr>
                </tbody>
            <?php
            } ?>
            </table>
            </div>
            

            

    </main>
    <?php include "../includes/footer.php"; ?>
    <?php
    include "../includes/scripts.php";
    ?>
</body>
</html>