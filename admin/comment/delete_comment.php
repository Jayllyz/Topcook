<?php
session_start();
include "../../includes/db.php";
$id_comment = htmlspecialchars($_GET["id_comment"]);
$id_recipe = htmlspecialchars($_GET["id_recipe"]);
$name_recipe = htmlspecialchars($_GET["name_recipe"]);


$selectReportCom = $db->prepare("SELECT COUNT(id) FROM REPORT_COM WHERE id_comment = :id_comment");
$selectReportCom->execute([
  "id_comment" => $id_comment,
]);
$countReportCom = $selectReportCom->fetch(PDO::FETCH_ASSOC);
if ($countReportCom["COUNT(id)"] !== 0) {
  $deleteReport = $db->prepare("DELETE FROM REPORT_COM WHERE id_comment = :id_comment");
  $deleteReport->execute([
    "id_comment" => $id_comment,
  ]);
}

$deleteMessage = $db->prepare("DELETE FROM COMMENTAIRE WHERE id = :id_comment");
$deleteMessage->execute([
  "id_comment" => $id_comment,
]);

header(
  "location: https://topcook.site/recipes/recipe.php?name=$name_recipe&id=$id_recipe&message=Commentaire supprimé avec succés !&type=success"
);
exit();
