<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../../includes/db.php";
$email = $_POST['email'];
$rights = $_POST['rights'];
$pseudo = $_POST['pseudo'];
$id_user = htmlspecialchars($_GET['id']);

if (isset($email) && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header(
        "location: ../update.php?message=Email invalide !&type=danger"
    );
    exit();
} else {
    setcookie("email", $email, time() + 3600, "/");
}



// Verifier si l'email n'est pas déja utiliser
if(isset($email) && !empty($email)) {
// Requete SELECT FROM ... WHERE
    $req = $db->prepare("SELECT id FROM USER WHERE email = :email");
    $req->execute([
        "email" => $_POST["email"],
    ]);
// Recupérer la première ligne de résultat
    $reponse = $req->fetch(); // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
// Si la ligne existe : erreur, l'email est déja utilisé
    if ($reponse) {
        header(
            "location: ../update.php?message=Cet email est déja utilisé !&type=danger"
        );
        exit();
    }
}


// Verifier si le pseudo n'est pas déja utiliser
if(isset($pseudo) && !empty($pseudo)) {
    $req = $db->prepare("SELECT id FROM USER WHERE pseudo = :pseudo");
    $req->execute([
        "pseudo" => $_POST["pseudo"],
    ]);
// Recupérer la première ligne de résultat
    $reponse = $req->fetch(); // Renvoie la première ligne sous forme de tableau ou une valeur booléenne FALSE
// Si la ligne existe : erreur, le pseudo est déja utilisé
    if ($reponse) {
        header(
            "location: ../update.php?message=Ce pseudo est déja utilisé !&type=danger"
        );
        exit();
    } else {
        setcookie("pseudo", $pseudo, time() + 3600, "/");
    }
}
if(isset($rights) && !empty($rights) || isset($pseudo) && !empty($pseudo) || isset($email) && !empty($email)) {
    setcookie("rights", $rights, time() + 3600, "/");


    $update = $db->prepare("UPDATE USER SET email = :email, pseudo = :pseudo, rights = :rights WHERE id = :id");
    $update->execute([
        "email" => $email,
        "pseudo" => $pseudo,
        "rights" => $rights,
        "id" => $id_user,
    ]);
    header("location: ../../admin.php?message=Modification effectué !&type=success");
    exit();
}

?>