<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Likes AJAX</title>
</head>
<body onload="countLike()">

    <?php include '../../includes/db.php'; ?>
    <?php
    $query = $db->prepare(
        "SELECT id, name, images, description, time_prep, time_cooking, nb_persons, type, id_user FROM RECIPE WHERE id = :id"
    );
    $query->execute([
        "id" => 49,
    ]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $select) { ?>
                <div id="like">
                    <img src="../../images/like.svg" alt="like" width="30" height="30" onclick="like(<?= $select['id'] ?>)">
                </div>
        <p id="result_like"></p>

<?php } ?>

<script src="js/likes.js"></script>
</body>
</html>