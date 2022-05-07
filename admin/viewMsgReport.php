<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/functions.php";
include "../includes/db.php";
$id_msg = htmlspecialchars($_GET['id_msg']);
$pseudo = htmlspecialchars($_GET['pseudo']);
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
        <?php
        $selectMsgReport = $db->query("SELECT id, message, date, id_user, id_topic FROM FORUM_MSG WHERE id = " . $id_msg);
        $msgReport = $selectMsgReport->fetch(PDO::FETCH_ASSOC);
        $selectTopic = $db->query("SELECT id, subject, id_user FROM TOPIC WHERE id = " . $msgReport['id_topic']);
        $topic = $selectTopic->fetch(PDO::FETCH_ASSOC);
        $selectUser = $db->query("SELECT id, pseudo FROM USER WHERE id = " . $topic['id_user']);
        $user = $selectUser->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="container">

            <h1 class="mb-3">Messages signalé rédiger par <em><?= $pseudo ?></em></h1>

            <div id="logs">
                <a href="https://topcook.site/admin/reportRead" class="btn mb-4">Recettes</a>
                <a href="https://topcook.site/admin/reportReadMsg" class="btn ms-4 mb-4">Messages</a>
                <a href="https://topcook.site/admin/reportReadCom" class="btn ms-4 mb-4">Commentaires</a>

            </div>
            <table class="table text-center table-bordered table-hover">
                <thead>
                    <th>Message</th>
                    <th>Date d'envoie</th>
                    <th>Auteur</th>
                    <th>Sujet</th>
                </thead>
                <tbody>
                    <td><?= $msgReport['message'] ?></td>
                    <td><?= $msgReport['date'] ?></td>
                    <td><?= $pseudo ?></td>
                    <td><a href="https://topcook.site/forum/subject.php?id_subject=<?= $topic['id'] ?>&creator=<?= $user['pseudo'] ?>&id_creator=<?= $topic['id_user'] ?>"><?= $topic['subject'] ?></a></td>
                </tbody>
            </table>
        </div>
    </main>

    <?php include "../includes/footer.php"; ?>

</body>

</html>