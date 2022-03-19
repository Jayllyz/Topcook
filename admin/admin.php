<?php
session_start();
include "../includes/db.php";
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Users";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>

    <h1>Liste des Utilisateurs</h1>
    <div class="container">
        <table class="table text-center table-bordered">
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Droits</th>
                <th>Actions</th>
            </tr>
            <?php
            $query = $db->prepare(
              'SELECT * FROM USER WHERE pseudo != "admin" AND rights != 1 ORDER BY id DESC'
            );
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $select) { ?>
            <tr>
                <td><?= $select["id"] ?></td>
                <td><?php
                if (!empty($select["image"])) {
                  echo '<img src="../uploads/' .
                    $select["image"] .
                    '" class="image-users me-3" alt="..." width="50">';
                }
                echo $select["pseudo"];
                ?></td>
                <td><?= $select["email"] ?></td>
                <td><?= $select["rights"] ?></td>
                <td>
                    <div class="button_profil">
                    <button type="button" class="btn-read btn">
                        <a href="users/read.php?id=<?= $select[
                          "id"
                        ] ?>" target="_blank">Consulter</a>
                    </button><br>
                    <button type="button" class="btn-update btn">
                        <a href="users/update.php?id=<?= $select[
                          "id"
                        ] ?>" target="_blank">Modifier</a>
                    </button><br>
                    <button type="button" class="btn-delete btn">
                        <a href="users/delete.php?id=<?= $select[
                          "id"
                        ] ?>" target="_blank">Supprimer</a>
                    </button>
                    </div>
                </td>
            </tr>
            <?php }
            ?>
        </table>
    </div>



    <?php include "../includes/footer.php"; ?>
</body>
</html>