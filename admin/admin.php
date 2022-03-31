<?php
session_start();
include "../includes/db.php";
if ($_SESSION["rights"] == 1 && isset($_SESSION["id"])) { ?>
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
        <table class="table text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Droits</th>
                    <th>Date de création de compte</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            $query = $db->query(
              "SELECT id, pseudo, email, rights, image,creation FROM USER WHERE rights != 1 ORDER BY id DESC"
            );
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $select) { ?>
            <tbody>
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
                    <td><?php
                    echo $select["rights"];
                    echo "<br>";
                    if ($select["rights"] == 0) {
                      echo "Utilisateur";
                    } elseif ($select["rights"] == 1) {
                      echo "Administrateur";
                    } elseif ($select["rights"] == -1) {
                      echo "Banni";
                    } elseif ($select["rights"] == 2) {
                      echo "Certifié";
                    }
                    ?></td>
                    <td><?= $select["creation"] ?></td>
                    <td>
                        <div class="button_profil">
                            <a href="users/read.php?id=<?= $select[
                              "id"
                            ] ?>" class="btn-read btn ms-2 me-2" target="_blank">Consulter</a>
                        <br>
                            <a href="users/update.php?id=<?= $select[
                              "id"
                            ] ?>&pseudo=<?= $select[
      "pseudo"
    ] ?>" class="btn-update btn ms-2 me-2" target="_blank">Modifier</a>
                        <br>

                        <button type="button" class="btn-ban btn ms-2 me-2" data-bs-toggle="modal" data-bs-target="#pop-up-del-<?= $select[
                          "id"
                        ] ?>"><?= $select["rights"] != -1
      ? "Bannir"
      : "Débannir" ?></button>
                        </button>
                        <div class="modal fade" id="pop-up-del-<?= $select[
                          "id"
                        ] ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Confirmation du <?= $select[
                                  "rights"
                                ] != -1
                                  ? "bannissement"
                                  : "débannissement" ?> de <span class="text-uppercase"><?= $select[
       "pseudo"
     ] ?></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Saisir le pseudo pour confirmation
                            <form action="users/ban.php?id=<?= $select[
                              "id"
                            ] ?>&pseudo=<?= $select["pseudo"] ?>&rights=<?= $select[
      "rights"
    ] ?>" method="post">
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
            </tbody>
            <?php }
            ?>
        </table>
        
    </div>



    <?php include "../includes/footer.php"; ?>

<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php } else {header("location: http://164.132.229.157/");
  exit();} ?>
