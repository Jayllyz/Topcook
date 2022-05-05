<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
include "../includes/functions.php";

if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) {
  $image_exist = 1;
  if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
    $acceptable = ["image/jpeg", "image/png"];

    if (!in_array($_FILES["image"]["type"], $acceptable)) {
      header(
        "location: admin.php?message=Type de fichier incorrect.&valid=invalid"
      );
      exit();
    }
    $maxSize = 2 * 1024 * 1024; //2Mo

    if ($_FILES["image"]["size"] > $maxSize) {
      header(
        "location: admin.php?message=Ce fichier est trop lourd.&valid=invalid"
      );
      exit();
    }
    $path = "../uploads";

    if (!file_exists($path)) {
      mkdir($path, 0777);
    }

    $filename = $_FILES["image"]["name"];

    $array = explode(".", $filename);
    $ext = end($array);

    $filename = "captcha-" . time() . "." . $ext;

    $destination = $path . "/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $destination);

    $link = "http://topcook.site/uploads/" . $filename;
    $name = $_POST["captcha"];

    $image = imagecreatefromjpeg($destination);
    $width = imagesx($image);
    $height = imagesy($image);

    $new_width = 630;
    $new_height = 354;

    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled(
      $new_image,
      $image,
      0,
      0,
      0,
      0,
      $new_width,
      $new_height,
      $width,
      $height
    );

    imagejpeg($new_image, $destination);
    imagedestroy($new_image);
    imagedestroy($image);
    cutImg($link, $name);
    header(
      "location: https://topcook.site/admin/admin.php?message=Captcha ajouté avec succès"
    );
    exit();
  }
}
