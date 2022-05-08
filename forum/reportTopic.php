<?php
session_start();
include "../includes/db.php";
if(!isset($_SESSION["id"])) {
    header("Location: https://topcook.site/");
    exit();
}
$id_topic = htmlspecialchars($_GET["id_topic"]);
$creator_name = htmlspecialchars($_GET["creator_name"]);
$creator = htmlspecialchars($_GET["id_creator"]);

$reportTopic = $db->prepare(
  "INSERT INTO REPORT_TOPIC (id_user, id_topic) VALUES (:id_user , :id_topic)"
);
$reportTopic->execute([
  "id_user" => $_SESSION["id"],
  "id_topic" => $id_topic,
]);
header(
  "location: https://topcook.site/forum/subject.php?id_subject=$id_topic&creator=$creator_name&id_creator=$creator&message=Sujet signalé avec succés !&type=success"
);
exit();
