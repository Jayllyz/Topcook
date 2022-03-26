<?php
session_start();
include "../../includes/db.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
$date = date("d/m/Y H:i:s");
$id = htmlspecialchars($_GET["id"]);
$pseudo = $_POST["pseudo"];
$pseudoUser = htmlspecialchars($_GET["pseudo"]);
$rights = htmlspecialchars($_GET["rights"]);

if ($pseudo == $pseudoUser) {
  if ($rights != -1) {
    $del = $db->prepare("UPDATE USER SET rights = -1 WHERE id = :id");
    $del->execute([
      "id" => $id,
    ]);
    $log_ban = fopen("../../log/log_ban.txt", "a+");
    fputs($log_ban, $id);
    fputs($log_ban, " banni le ");
    fputs($log_ban, $date);
    fputs($log_ban, "\n");
    fclose($log_ban);

    header(
      "location: ../admin.php?message=Utilisateur banni avec succès&type=success"
    );
    exit();
  } else {
    $del = $db->prepare("UPDATE USER SET rights = 0 WHERE id = :id");
    $del->execute([
      "id" => $id,
    ]);
    $log_deban = fopen("../../log/log_deban.txt", "a+");
    fputs($log_deban, $id);
    fputs($log_deban, " débani le ");
    fputs($log_deban, $date);
    fputs($log_deban, "\n");
    fclose($log_deban);

    header(
      "location: ../admin.php?message=Utilisateur débanni avec succès&type=success"
    );
    exit();
  }
} else {
  header(
    'location: ../admin.php?message=Le nom d\'utilisateur saisi est incorrect ! Veuillez réessayer.&type=danger'
  );
  exit();
}

?>
