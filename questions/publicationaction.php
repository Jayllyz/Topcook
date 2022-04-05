<?php
  include "includes/db.php";

  $getAllMyQuestions = $db->prepare('SELECT id, titre, description FROM questions);
  $getAllMyQuestions->execute(array($_SESSION['id']));

?>
