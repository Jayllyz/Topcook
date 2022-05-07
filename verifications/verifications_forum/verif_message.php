<?php
session_start();
include "../../includes/db.php";
include "../../includes/functions.php";
$date = date("d-m-Y H:i:s");
if (isset($_SESSION["id"])) {
  $message = $_POST["message"];
  $id_topic = htmlspecialchars($_GET["id_topic"]);

  $query = $db->prepare(
    "INSERT INTO FORUM_MSG(message, id_topic, id_user, date) VALUES(:message, :id_topic, :id_user, :date)"
  );
  $query->execute([
    "message" => $message,
    "id_topic" => $id_topic,
    "id_user" => $_SESSION["id"],
    "date" => $date,
  ]);
  $count = banword("https://topcook.site/banlist.txt", $message, $db, 1);
  if ($count > 0) {
    header("location: https://topcook.site/forum/subject.php?id_subject=$id_topic&message=Message ajouté mais avec $count bouteilles!&type=warning");
    exit();
  }
  header(
    "Location: ../../forum/subject.php?id_subject=$id_topic&message=Votre message a bien été envoyé !&type=success"
  );
  exit();
} else {
  header("Location: topic.php?message=Vous devez être connecté&type=danger");
  exit();
}
