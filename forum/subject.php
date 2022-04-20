<?php
session_start();
include "../includes/db.php";
$id_subject = htmlspecialchars($_GET["id_subject"]);
$pseudo = htmlspecialchars($_GET["creator"]);
$id_creator = htmlspecialchars($_GET["id_creator"]);

$selectTopic = $db->query(
    "SELECT subject, message, image, date FROM TOPIC WHERE id = " .
    $id_subject
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
        <p>Créé par : <strong><?= $pseudo ?></strong></p>
        <p>Date de création : <strong><?= $date ?></strong></p>
        <div class="description d-flex justify-content-center">
            <span class="d-flex">Description :<p class="ms-3 me-3" id="description"></span>

                <strong id="message"><?= $message ?></strong>
                <?php
                if($id_creator == $_SESSION["id"] || $_SESSION['rights'] == 1){

                ?>
        <div class="modify">
            <img src="../images/crayon.png" id="crayon" width="30" height="30" alt="modify" class="modify">
        </div>
        <?php } ?>
            </p>
        </div>



    </div>


            

    <div class="commentaires">
        
        <form action="../verifications/verifications_forum/verif_message.php?id_topic=<?= $id_subject ?>" method="post">
                        <label class="form-label" >Saisir un message</label>
                        <textarea name="message" class="form-control mb-3" id="comment"></textarea>
                        <input type="submit" class="form-control btn btn-success mb-3"  name="submit" value="Envoyer">
        </form>
                </div>
                <div class="messages mt-5 mb-5">
                <table class="table text-center table-bordered table-hover">
                <thead>
                <?php
                $selectUserCreateMsg = $db->prepare(
                  "SELECT id_user FROM FORUM_MSG WHERE id = :id"
                );
                $selectUserCreateMsg->execute([
                  "id" => htmlspecialchars($_GET["id"]),
                ]);
                $resultUserCreateMsg = $selectUserCreateMsg->fetch(
                  PDO::FETCH_ASSOC
                );
                ?>
                <tr>
                    <th>Pseudo</th>
                    <th>Message</th>
                    <th>Date</th>
                    <?php if (
                      $_SESSION["rights"] == 1 ||
                      $id_creator == $_SESSION["id"]
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
                                        <td><?= $message["message"] ?></td>
                                        <td id="date_send"><?= $message[
                                          "date"
                                        ] ?></td>
                                        <?php if (
                                          $_SESSION["rights"] == 1 ||
                                          $id_creator ==
                                            $_SESSION["id"]
                                        ) { ?>
                                        <td><a href="../admin/comment/delete_topic_msg.php?id_creator=<?=$id_creator?>&creator=<?=$pseudo?>&id_msg=<?= $message["id"] ?>&id_topic=<?= $id_subject ?>&id_subject=<?=$id_subject?>" class="btn btn-ban">Supprimer</a></td>
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
<?php include "../includes/footer.php"; ?>
<?php
include "../includes/scripts.php";
?>
</body>
</html>