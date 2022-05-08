<?php
session_start();
$id_topic = htmlspecialchars($_GET["id"]);
$pseudo = htmlspecialchars($_GET["pseudo"]);
$id_creator = htmlspecialchars($_GET["id_creator"]);
include "../includes/db.php";

if (isset($_SESSION["id"]) && ($_SESSION["id"] == $id_creator || $_SESSION["rights"] == 1)) {
    $selectMsg = $db->query("SELECT id FROM FORUM_MSG WHERE id_topic = " . $id_topic);
    $selectMsg = $selectMsg->fetchAll(PDO::FETCH_ASSOC);
    foreach ($selectMsg as $msg) {
        $deleteReport = $db->prepare("DELETE FROM FORUM_MSG_REPORT WHERE id_msg = :id_msg");
        $deleteReport->execute([
            "id_msg" => $msg["id"],
        ]);
        $deleteCom = $db->prepare("DELETE FROM FORUM_MSG WHERE id_topic = :id_topic AND id = :id_msg");
        $deleteCom->execute([
            "id_topic" => $id_topic,
            "id_msg" => $msg["id"],
        ]);
    }

    $deleteReportTopic = $db->prepare("DELETE FROM REPORT_TOPIC WHERE id_topic = :id_topic");
    $deleteReportTopic->execute([
        "id_topic" => $id_topic,
    ]);

    $req = $db->prepare(
        "DELETE FROM TOPIC WHERE id = :id_topic"
    );
    $req->execute([
        "id_topic" => $id_topic,
    ]);

    header(
        "location: https://topcook.site/forum/?message=Sujet supprimée !&type=success"
    );
    exit();
} else {
    header(
        "location: https://topcook.site/forum/subject.php?id_subject=$id_topic&creator=$pseudo&id_creator=$id_creator&message=Vous ne pouvez pas supprimé cette recette !&type=danger"
    );
    exit();
}
