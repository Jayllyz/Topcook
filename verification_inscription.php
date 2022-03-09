<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include 'includes/db.php';

        $req = $db->prepare('INSERT INTO USER (pseudo,email,password,date_birth) VALUES (:pseudo,:email,:password,:date_birth)');
        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];
        $birth = $_POST['birth'];
        $req->execute(array(
            'pseudo' => $pseudo, 
            'email' => $email,
            'password' => $password,
            'date_birth' => $birth
        ));
?>