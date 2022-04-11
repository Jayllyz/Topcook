<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../includes/db.php";
$id_topic = htmlspecialchars($_GET['id_topic']);
$id_msg = htmlspecialchars($_GET['id_msg']);
$id_subject = htmlspecialchars($_GET['id_subject']);
$id_creator = htmlspecialchars($_GET['id_creator']);
$creator = htmlspecialchars($_GET['creator']);

$deleteMsg = $db->prepare('DELETE FROM FORUM_MSG WHERE id_topic = :id_topic AND id = :id_msg');
$deleteMsg->execute([
    'id_topic' => $id_topic,
    'id_msg' => $id_msg
]);
header("location: https://topcook.site/forum/subject.php?id_subject=$id_subject&id_creator=$id_creator&creator=$creator&message=Message supprimé avec succès !&type=success");
exit();



?>
