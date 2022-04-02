<?php
session_start();
include "../includes/db.php";
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "$_GET[name]";
include "../includes/head.php";
?>
<body>

    <?php include "../includes/header.php"; ?>
        <main>
            <?php 
                $query = $db->prepare(
                    "SELECT images, description, time_prep, time_cooking, nb_persons, type, votes FROM RECIPE WHERE name = :name"
                );
                $query->execute([
                    "name" => $_GET["name"],
                ]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $select) { ?>
            <div class="container col-md-6">
                <?= '<img src="../uploads/recipe/' . $select["images"] . '" class="rounded img-fluid" alt="image -' . $select['names'] . '"></a>'; ?>
                <p><?= 'Nom :' . $_GET['name'] ?></p>
                <p><?= 'Description :' . $select['description'] ?></p>
                <p><?= 'Preparation :' .$select['time_prep'] ?></p>
                <p><?= 'Cuisine :' .$select['time_cooking'] ?></p>
                <p><?= 'Pour :' . $select['nb_persons'] . 'personnes' ?></p>
                <p><?= 'Type :' .$select['type'] ?></p>
                <p><?= 'Votes :' .$select['votes'] ?></p>
            </div>
            <?php } ?>
        </main>
    <?php include "../includes/footer.php"; ?>
</body>
</html>  