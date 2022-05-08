<?php
session_start();
include "../../includes/db.php";

$id_topic = htmlspecialchars($_GET['id_topic']);
$id_msg = htmlspecialchars($_GET['id_msg']);
$id_subject = htmlspecialchars($_GET['id_subject']);
$id_creator = htmlspecialchars($_GET['id_creator']);
$creator = htmlspecialchars($_GET['creator']);

$selectReportMsg = $db->prepare("SELECT COUNT(id) FROM FORUM_MSG_REPORT WHERE id_msg = :id_msg");
$selectReportMsg->execute([
    "id_msg" => $id_msg,
]);
$countReportMsg = $selectReportMsg->fetch(PDO::FETCH_ASSOC);
if ($countReportMsg["COUNT(id)"] !== 0) {
    $deleteReport = $db->prepare("DELETE FROM FORUM_MSG_REPORT WHERE id_msg = :id_msg");
    $deleteReport->execute([
        "id_msg" => $id_msg,
    ]);
}

$deleteMsg = $db->prepare('DELETE FROM FORUM_MSG WHERE id = :id_msg');
$deleteMsg->execute([
    'id_msg' => $id_msg
]);
header("location: https://topcook.site/forum/subject.php?id_subject=$id_subject&id_creator=$id_creator&creator=$creator&message=Message supprimé avec succès !&type=success");
exit();
