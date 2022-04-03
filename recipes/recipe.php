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
                <p><?= 'Nom :' . $_GET['name'] ?>
                <div class="nb_pers">
                    <div>
                        <label class="form-label">Nombres de personnes: <span class="pers"><?=$select['nb_persons']?></span>
                    </div>
                    <div class="logo-add-remove-persons">
                        <button class="btn plus" onclick="addPers()"><img src="../images/plus-lg.svg"></button>
                        <button class="btn dash" onclick="removePers()"> <img src="../images/dash-lg.svg"></button>
                    </div>
                    </label>
                </div></p>
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

    <script src="../js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>  