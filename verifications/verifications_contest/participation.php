<?php
session_start();
$idContest = htmlspecialchars($_GET['id']);
include '../../includes/db.php';
if (isset($_SESSION['id'])) {
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        // Vérifier le type de fichier
        $acceptable = ["image/jpeg", "image/png"];

        if (!in_array($_FILES["image"]["type"], $acceptable)) {
            // Rediriger vers inscription.php avec un message d'erreur
            header(
                "location: https://topcook.site/concours.php?message=Type de fichier incorrect.&type=danger"
            );
            exit();
        }

        // Vérifier le poids du fichier
        $maxSize = 2 * 1024 * 1024; //2Mo

        if ($_FILES["image"]["size"] > $maxSize) {
            // Rediriger vers inscription.php avec un message d'erreur
            header(
                "location: https://topcook.site/concours.php?message=Ce fichier est trop lourd.&type=danger"
            );
            exit();
        }

        // Enregistrer le fichier sur le serveur

        // Chemin d'enregistrement
        $path = "../../uploads/uploadsParticipate";

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
    }
    $select = $db->query("SELECT idContest FROM USER WHERE id = " . $_SESSION['id']);
    $result = $select->fetch(PDO::FETCH_ASSOC);
    if ($result['idContest'] !== $idContest) {
        $insertParticipation = $db->prepare("UPDATE USER SET idContest = :idContest, imageContest = :imageContest WHERE id = " . $_SESSION['id']);
        $insertParticipation->execute([
            "idContest" => $idContest,
            "imageContest" => isset($filename) ? $filename : "",
        ]);
        header("location: https://topcook.site/concours.php?message=Votre participation a bien été enregistrée.&type=success");
        exit();
    } else {
        header("location: https://topcook.site/concours.php?message=Vous avez déjà participé à ce concours.&type=danger");
        exit();
    }
} else {
    header("location: https://topcook.site/concours.php?message=Vous devez être connecté pour participer.&type=danger");
    exit();
}
