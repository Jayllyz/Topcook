<?php
session_start();
$id_topic = htmlspecialchars($_GET["id"]);
$pseudo = htmlspecialchars($_GET["pseudo"]);
$id_creator = htmlspecialchars($_GET["id_creator"]);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

var_dump($_SESSION["rights"]);

if (isset($_SESSION["id"]) && ($_SESSION["id"] == $id_creator || $_SESSION["rights"] == 1)) {
    $selectMsgReport = $db->query("SELECT id_msg FROM FORUM_MSG_REPORT");
    $resultMsgReport = $selectMsgReport->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultMsgReport as $msgReport) {
        $deleteReport = $db->prepare("DELETE FROM FORUM_MSG_REPORT WHERE id_msg = :id_msg IN (SELECT id_msg FROM FORUM_MSG_REPORT WHERE id_topic = :id_topic)");
        $deleteReport->execute([
            "id_msg" => $msgReport["id_msg"],
            "id_topic" => $id_topic,
        ]);
    }
    $req = $db->prepare("DELETE FROM FORUM_MSG WHERE id_topic = :id_topic");
    $req->execute([
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
