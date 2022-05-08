<?php
session_start();
include "../../includes/db.php";
$id_user = htmlspecialchars($_GET["id"]);
$date = date("d-m-Y H:i:s");

if (isset($_SESSION["id"])) {
  $subject = htmlspecialchars($_POST["subject"]);
  $message = htmlspecialchars($_POST["message"]);

  $image_exist = 1;
  if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {

    $acceptable = ["image/jpeg", "image/png"];

    if (!in_array($_FILES["image"]["type"], $acceptable)) {

      header(
        "location: https://topcook.site/forum?message=Type de fichier incorrect.&valid=invalid&input=fichier"
      );
      exit();
    }


    $maxSize = 2 * 1024 * 1024; //2Mo

    if ($_FILES["image"]["size"] > $maxSize) {

      header(
        "location: https://topcook.site/forum?message=Ce fichier est trop lourd.&valid=invalid&input=fichier"
      );
      exit();
    }

    $path = "../../uploads/img_topic";

    if (!file_exists($path)) {
      mkdir($path, 0777);
    }

    $filename = $_FILES["image"]["name"];

    $array = explode(".", $filename);
    $ext = end($array);

    $filename = "image-" . time() . "." . $ext;

    $destination = $path . "/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
    include "../../includes/resolution.php";
  } else {
    $image_exist = 0;
  }

  if (!isset($_POST["subject"]) || trim(strlen($_POST["subject"])) > 25) {
    header(
      "location: https://topcook.site/forum?message=Veuillez entrer un sujet valide.&type=danger"
    );
    exit();
  }

  if (!isset($_POST["message"])) {
    header(
      "location: https://topcook.site/forum?message=Veuillez entrer un message valide.&type=danger"
    );
    exit();
  }

  $insert = $db->prepare(
    "INSERT INTO TOPIC (subject, date, message, image, id_user) VALUES (:subject, :date, :message, :image, :id_user)"
  );

  $image = $filename;


  $insert->execute([
    "subject" => $subject,
    "date" => $date,
    "message" => $message,
    "image" => isset($image) ? $image : "",
    "id_user" => $id_user,
  ]);

  header(
    "location: https://topcook.site/forum?message=Votre topic a bien été créé.&type=success"
  );
  exit();
} else {
  header("Location: https://topcook.site/forum?message=tg&type=danger");
  exit();
}
