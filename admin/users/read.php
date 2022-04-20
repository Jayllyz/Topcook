<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
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
    <div class="container info_user">
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
        <h2 class="mt-3 mb-3">Commentaires recette</h2>
        <div class="container">
            <table class="table text-center table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Recette</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
                $selectMessage = $db->prepare(
                  "SELECT message, id_recipe, date_send FROM COMMENTAIRE WHERE id_user = :id ORDER BY date_send DESC LIMIT 10"
                );
                $selectMessage->execute([
                  "id" => $id,
                ]);
                $result = $selectMessage->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $selectMessage) { ?>
                        <?php
                    $idRecipe = $selectMessage["id_recipe"];
                        $selectRecipe = $db->prepare(
                          "SELECT name FROM RECIPE WHERE id = :id"
                        );
                        $selectRecipe->execute([
                          "id" => $selectMessage["id_recipe"],
                        ]);
                        $result = $selectRecipe->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $selectRecipe) {
                            $nameRecipe = $selectRecipe["name"];
                            ?>
                <tr>
                    <td><a href="https://topcook.site/recipes/recipe.php?name=<?= $nameRecipe ?>&id=<?= $idRecipe ?>"><?= $selectRecipe["name"] ?></a></td>
                    <td><?= $selectMessage["message"] ?></td>
                    <td><?= $selectMessage["date_send"] ?></td>
                </tr>
                <?php }
                }?>
            </table>
        </div>

    <?php }
    ?>
    <h2 class="mt-3 mb-3">Messages topic</h2>
    <div class="container">
        <table class="table text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <?php

            $selectTopic = $db->query(
              "SELECT id, subject, id_user FROM TOPIC"
            );
            $resultIdTopic = $selectTopic->fetchAll(PDO::FETCH_ASSOC);

            foreach($resultIdTopic as $topic){
                $idTopic = $topic['id'];
                $subject = $topic['subject'];
                $idUser = $topic['id_user'];

                $selectUser = $db->prepare(
                  "SELECT pseudo FROM USER WHERE id = :id"
                );
                $selectUser->execute([
                  "id" => $idUser,
                ]);
                $result = $selectUser->fetch(PDO::FETCH_ASSOC);
                $creator = $result['pseudo'];

            $selectTopicMessage = $db->prepare("SELECT message, date FROM FORUM_MSG WHERE id_user = :id_user AND id_topic = :id_topic ORDER BY date DESC LIMIT 10");
            $selectTopicMessage->execute([
              "id_user" => $id,
              "id_topic" => $idTopic,
            ]);

            $resultTopic = $selectTopicMessage->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultTopic as $selectTopicMessage) {
                    $messageTopic = $selectTopicMessage["message"];
                    $dateTopic = $selectTopicMessage["date"];
                ?>
                    <tr>
                        <td><a href="https://topcook.site/forum/subject.php?id_subject=<?= $idTopic ?>&creator=<?= $creator ?>&id_creator=<?= $idUser ?>"><?= $subject ?></a></td>
                        <td><?= $messageTopic ?></td>
                        <td><?= $dateTopic ?></td>
                    </tr>
                <?php }}?>
        </table>

    </div>

    <?php include "../../includes/footer.php"; ?>
    <?php
    include "../../includes/scripts.php";
    ?>
</body>
</html>
<?php } else {header("location: http://164.132.229.157/");
  exit();} ?>
