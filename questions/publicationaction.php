<?php
  session_start();
  include "../includes/db.php";

  $getAllMyQuestions = $bdd->prepare('SELECT id, titre, description FROM questions WHERE id_auteur = ?');
  $getAllMyQuestions->execute(array($_SESSION['id']));

?>
