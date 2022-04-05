<?php

session_start();
include "../includes/db.php";

if(isset($_POST['bouton']))
{
  if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['contenu']))
  {
    $question_title = htmlspecialchars($_POST['title']);
    $question_description = nl2br(htmlspecialchars($_POST['description']));

    $question_contenu = nl2br(htmlspecialchars($_POST['contenu']));
    $question_date = date('d/m/Y');
    $question_id_author = $_SESSION['id'];
    $question_pseudo_author = $_SESSION['pseudo'];

    $insertQuestionsOnWebsite = $bdd->prepare('INSERT INTO questions(titre, description, contenu, id_auteur, pseudo_auteur, date_publication)VALUES(?,?,?,?,?,?)');
    $insertQuestionsOnWebsite->execute(array($question_title,$question_description,$question_contenu,$question_id_author,$question_pseudo_author,$question_date));

    $successMsg = "Votre question a bien été publié sur le site";
  }
  else
  {
    $errorMsg = "Veuillez compléter tout les champs";
  }
}

?>
