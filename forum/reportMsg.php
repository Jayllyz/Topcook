<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$id_subject = htmlspecialchars($_GET["id_subject"]);
$id_topic = htmlspecialchars($_GET["id_topic"]);
$id = htmlspecialchars($_GET["id_msg"]);
$creator_name = htmlspecialchars($_GET["creator"]);
$creator = htmlspecialchars($_GET["id_creator"]);
$id_msg = htmlspecialchars($_GET["id_msg"]);

$reportMessage = $db->prepare(
  "INSERT INTO FORUM_MSG_REPORT (id_user, id_msg) VALUES (:id_user , :id_msg)"
);
$reportMessage->execute([
  "id_user" => $_SESSION["id"],
  "id_msg" => $id_msg,
]);
header(
  "location: https://topcook.site/forum/subject.php?id_subject=$id_subject&creator=$creator_name&id_creator=$creator&message=Message signalé avec succés !&type=success"
);
exit();

?>
