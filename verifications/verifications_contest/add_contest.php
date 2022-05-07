<?php
session_start();
include '../../includes/db.php';

$title = $_POST['title'];
$rules = $_POST['rules'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$theme = $_POST['theme'];


if(isset($_SESSION['id'])){
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        // Vérifier le type de fichier
        $acceptable = ["image/jpeg", "image/png"];

        if (!in_array($_FILES["image"]["type"], $acceptable)) {
            // Rediriger vers inscription.php avec un message d'erreur
            header(
                "location: https://topcook.site/contest/createContest.php?message=Type de fichier incorrect.&valid=invalid&input=fichier"
            );
            exit();
        }

        // Vérifier le poids du fichier
        $maxSize = 2 * 1024 * 1024; //2Mo

        if ($_FILES["image"]["size"] > $maxSize) {
            // Rediriger vers inscription.php avec un message d'erreur
            header(
                "location: https://topcook.site/contest/createContest.php?message=Ce fichier est trop lourd.&valid=invalid&input=fichier"
            );
            exit();
        }

        // Enregistrer le fichier sur le serveur

        // Chemin d'enregistrement
        $path = "../../uploads/img_contest/";

        // Vérifier que le dossier uploads existe, sinon le créer
        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $filename = $_FILES["image"]["name"];

        // Créer un nom de fichier à partir de la date (timestamp)
        // image-1613985411.ext
        // Attention : deux fichiers uploadés dans la même seconde auront le même nom !!

        // Récupérer l'extension du fichier
        $array = explode(".", $filename);
        $ext = end($array); // extension du fichier

        $filename = "image-" . time() . "." . $ext;

        // Déplacer le fichier vers son emplacement définitif (le dossier uploads)
        $destination = $path . "/" . $filename;
        move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
        include "../../includes/resolution.php";
    }else{
        header("location: https://contest/createContest.php?message=Veuillez choisir une image.&type=danger");
        exit();
    }
    if(isset($title) && !empty($title) && isset($rules) && !empty($rules) && isset($start_date) && !empty($start_date) && isset($end_date) && !empty($end_date) && isset($theme) && !empty($theme) && $theme != "0"){

        if($start_date < $end_date){
            $req = $db->prepare("INSERT INTO CONTEST (name, date_start, date_end, description, theme, image) VALUES (:name , :date_start , :date_end , :description , :theme, :image)");
            $req->execute([
                "name" => $title,
                "date_start" => $start_date,
                "date_end" => $end_date,
                "description" => $rules,
                "theme" => $theme,
                "image" => isset($filename) ? $filename : ""
            ]);
            header("location: https://topcook.site/concours.php?message=Concours créé avec succès.&type=success");
            exit();
        }else{
            header("location: https://topcook.site/contest/createContest.php?message=La date de début doit être antérieure à la date de fin.&type=danger");
            exit();
        }
    }




}else{
    header("Location: https://topcook.site");
    exit();
}
