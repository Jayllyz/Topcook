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

    <div class="container col-md-6">
      <?php include "../includes/message.php"; ?>
    </div>

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
                    <button type="button" class="btn-read btn ms-2 me-2">
                        <a href="users/read.php?id=<?= $select[
                          "id"
                        ] ?>" target="_blank">Consulter</a>
                    </button><br>
                    <button type="button" class="btn-update btn ms-2 me-2">
                        <a href="users/update.php?id=<?= $select[
                          "id"
                        ] ?>" target="_blank">Modifier</a>
                    </button><br>

                    <button type="button" class="btn-delete btn ms-2 me-2" data-bs-toggle="modal" data-bs-target="#pop-up-del">
                    Supprimer
                    </button>

                    <div class="modal fade" id="pop-up-del">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Confirmation de supression de <span class="text-uppercase"><?= $select[
                              "pseudo"
                            ] ?></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Saisir le pseudo pour confirmation
                            <form action="users/delete.php?id=<?= $select[
                              "id"
                            ] ?>&pseudo=<?= $select["pseudo"] ?>" method="post">
                                <div class="container col-md-8">
                                  <input type="text" class="form-control" name="pseudo" placeholder="<?= $select[
                                    "pseudo"
                                  ] ?>" required>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" name="submit" value="Valider" class="btn btn-success">
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    </div>
                </td>
            </tr>
            <?php }
            ?>
        </table>
    </div>



    <?php include "../includes/footer.php"; ?>
</body>

<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>