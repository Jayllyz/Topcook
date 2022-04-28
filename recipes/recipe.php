<?php
session_start();
include "../includes/db.php";
include "../includes/functions.php";
$nbSteps = htmlspecialchars($_GET["nbSteps"]);
$name = htmlspecialchars($_GET["name"]);
$date = date("d/m/Y H:i:s");
$log_recipe = fopen("../log/recipe_logs/$name.txt", "a+");
fputs($log_recipe, $name . " ");
fputs($log_recipe, "visité le ");
fputs($log_recipe, $date);
fputs($log_recipe, "\n");
fclose($log_recipe);
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "";
include "../includes/head.php";
?>
<body>

    <?php include "../includes/header.php"; ?>
        <main>
        <div class="container col-md-6">
            <?php include "../includes/message.php"; ?>
        </div>
            <?php
            $selectFavorite = $db->query("SELECT idUser, idRecipe FROM FAVORITE_RECIPE WHERE idUser = ".$_SESSION["id"]." AND idRecipe = ".$_GET["id"]);
            $favorite = $selectFavorite->fetch(PDO::FETCH_ASSOC);
            $idUserFavorite = $favorite["idUser"];
            $idRecipeFavorite = $favorite["idRecipe"];


            $query = $db->prepare(
              "SELECT id, name, images, description, time_prep, time_cooking, nb_persons, type, id_user FROM RECIPE WHERE id = :id"
            );
            $query->execute([
              "id" => htmlspecialchars($_GET["id"]),
            ]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $select) { ?>
            <div class="container col-md-6 shadow-lg recipe-page">
                <?= '<img src="../uploads/recipe/' .
                  $select["images"] .
                  '" class="img-fluid" id="img_recipe" alt="image -' .
                  $select["names"] .
                  '"></a>' ?>
                <div class="test">
                    <div class="head-recipe">
                        <p>Nom : <span><?= "<strong>" .
                          $_GET["name"] .
                          "</strong></span>" ?>
                        <div class="nb_pers">
                            <div>
                                <label class="form-label">Nombres de personnes: <span id="pers"><?= $select[
                                  "nb_persons"
                                ] ?></span>
                            </div>
                            <div class="logo-add-remove-persons">
                                <img src="../images/plus-lg.svg" onclick="addPers()">
                                <img src="../images/dash-lg.svg" onclick="removePers()">
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
                <?php
                if($idUserFavorite !== $_SESSION['id']){
                ?>
                <button class="btn mb-3" id="add_favorite" onclick="addFavorite(<?=$select['id']?>)">Ajouter aux favoris</button>
                <?php } else { ?>
                <button class="btn btn-ban mb-3" id="add_favorite" onclick="removeFavorite(<?=$select['id']?>)">Retirer des favoris</button>
                <?php } ?>
                <div id="result_favorite"></div>
                <p><?= "Description : " . $select["description"] ?></p>
                <p><?= "Preparation : " . $select["time_prep"] ?> min</p>
                <p><?= "Cuisson : " . $select["time_cooking"] ?> min</p>
                <p><?= "Type : " . $select["type"] ?></p>
                <?php
                $selectLike = $db->prepare(
                  "SELECT votes FROM LIKES WHERE id_recipe = :id_recipe"
                );
                $selectLike->execute([
                  "id_recipe" => $select["id"],
                ]);
                $resultLike = count($selectLike->fetchAll(PDO::FETCH_ASSOC));
                ?>
                <div class="d-flex flex-row">
                    <p class="pe-3 fs-4"><?= $resultLike ?></p>

                    <?php
                    $selectCount = $db->prepare(
                      "SELECT count(id) FROM LIKES WHERE id_user = :id_user AND id_recipe = :id_recipe"
                    );
                    $selectCount->execute([
                      "id_user" => $_SESSION["id"],
                      "id_recipe" => $select["id"],
                    ]);
                    $count = $selectCount->fetch(PDO::FETCH_NUM);
                    ?>

                    <?php if (!isset($_SESSION["id"]) || $count[0] == 0) { ?>
                        <a href="like.php?id=<?= $select[
                          "id"
                        ] ?>&name=<?= $select[
  "name"
] ?>"><img src="../images/like.svg" width="30"></a>
                    <?php } else { ?>
                    <a href="unlike.php?id=<?= $select[
                      "id"
                    ] ?>&name=<?= $select["name"] ?>">
                        <img src="../images/like.svg" class="validate" width="30"></a>
                    <?php } ?>
                </div>

                <?php if (
                  $_SESSION["rights"] == 1 ||
                  $_SESSION["id"] == $select["id_user"]
                ) { ?>
                  <div class="btn_ingredients mb-4">
                            <a href="deleteRecipe.php?id=<?= $select[
                              "id"
                            ] ?>&id_user=<?= $select[
  "id_user"
] ?>&name=<?= $select[
  "name"
] ?>" onclick="return checkConfirm('Voulez vous vraiment supprimer cette recette?')" class="btn btn-danger">
                                Supprimer la recette
                            </a>
                        </div>
                 <?php } ?>



                <div class="list_ingredient">
                    <h3>Ingrédients</h3> 
                    <?php if (
                      $_SESSION["rights"] == 1 ||
                      $_SESSION["id"] == $select["id_user"]
                    ) { ?>
                        <div class="btn_ingredients mb-4">
                            <a href="ingredients.php?name=<?= $select[
                              "name"
                            ] ?>&id=<?= $select[
  "id"
] ?>&nbSteps=<?= $nbSteps ?>" class="btn">
                                Modifier les ingrédients
                            </a>
                        </div>
                    <?php } ?>
                    <?php
                    $selectIngredients = $db->prepare(
                      "SELECT name, quantity, unit FROM INGREDIENT WHERE id_recipe = :id_recipe"
                    );
                    $selectIngredients->execute([
                      "id_recipe" => $select["id"],
                    ]);
                    $resultIngredients = $selectIngredients->fetchAll(
                      PDO::FETCH_ASSOC
                    );
                    ?>

                        <?php foreach ($resultIngredients as $ingredient) { ?>
                            <div class="info_ingredients">

                        <p class="name_ingredient"><?= $ingredient[
                          "name"
                        ] ?></p>
                                <span><p class="quantity"><?= $ingredient[
                                  "quantity"
                                ] ?></p><strong><?= $ingredient[
  "unit"
] ?></strong></span>
                    </div>
                        <?php } ?>

                </div>
                <div class="list_steps">
                    <h3>Préparation</h3>
                    <?php
                    $query = $db->prepare(
                      "SELECT details,orders FROM STEPS WHERE id_recipe = :id_recipe"
                    );
                    $query->execute([
                      "id_recipe" => htmlspecialchars($_GET["id"]),
                    ]);
                    $selectSteps = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($selectSteps as $steps) {
                      $steps["orders"] += 1; ?>
                        <h4><?= "Etape " . $steps["orders"] ?></h4>
                        <p><?= $steps["details"] ?></p>

                   <?php
                    }
                    ?>
                </div>
                
                <?php
                $selectReport = $db->prepare(
                  "SELECT count(id) FROM REPORT_RECIPE WHERE id_user = :id_user AND id_recipe = :id_recipe"
                );
                $selectReport->execute([
                  "id_user" => $_SESSION["id"],
                  "id_recipe" => $select["id"],
                ]);
                $selectReport = $selectReport->fetch(PDO::FETCH_NUM);
                ?>

                 <?php if (isset($_SESSION["id"]) && $selectReport[0] == 0) { ?>
                  <div class="btn_ingredients mb-4">
                            <a href="reportRecipe.php?id=<?= $select[
                              "id"
                            ] ?>&id_user=<?= $select[
  "id_user"
] ?>&name=<?= $select[
  "name"
] ?>" onclick="return checkConfirm('Voulez vous vraiment signaler cette recette?')" class="btn btn-danger">
                                Signaler la recette
                            </a>
                        </div>
                 <?php } ?>


                <div class="commentaires">
                    <h3>Commentaires</h3>
                    <form action="commentaires.php?id_recipe=<?= htmlspecialchars(
                      $_GET["id"]
                    ) ?>&name=<?= $select["name"] ?>" method="post">
                        <label class="form-label" >Saisir un commentaire</label>
                        <textarea name="comment" class="form-control mb-3" id="comment"></textarea>
                        <input type="submit" class="form-control btn btn-success mb-3"  name="submit" value="Commenter">
                    </form>
                </div>
                <div class="messages mt-5 mb-5">
                <table class="table text-center table-bordered table-hover">
                <thead>
                <?php
                $selectUserCreateRecipe = $db->prepare(
                  "SELECT id_user FROM RECIPE WHERE id = :id"
                );
                $selectUserCreateRecipe->execute([
                  "id" => htmlspecialchars($_GET["id"]),
                ]);
                $resultUserCreateRecipe = $selectUserCreateRecipe->fetch(
                  PDO::FETCH_ASSOC
                );
                ?>
                <tr>
                    <th>Pseudo</th>
                    <th>Message</th>
                    <th>Date</th>
                    <?php if (isset($_SESSION["id"])) { ?>
                    <th>Signaler</th>
                    <?php } ?>
                    <?php if (
                      $_SESSION["rights"] == 1 ||
                      $resultUserCreateRecipe["id_user"] == $_SESSION["id"]
                    ) { ?>
                    <th>Supprimer</th>
                          <?php } ?>
                    
        <?php }
            ?>
                </tr>
                </thead>
                    <?php
                    $query = $db->prepare(
                      "SELECT id, message, id_recipe, id_user, date_send FROM COMMENTAIRE WHERE id_recipe = :id_recipe ORDER BY date_send DESC"
                    );
                    $query->execute([
                      "id_recipe" => htmlspecialchars($_GET["id"]),
                    ]);
                    $selectMessages = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($selectMessages as $message) { ?>
                    <?php
                    $selectReportCom = $db->prepare(
                      "SELECT count(id) FROM REPORT_COM WHERE id_user = :id_user AND id_comment = :id_comment"
                    );
                    $selectReportCom->execute([
                      "id_user" => $_SESSION["id"],
                      "id_comment" => $message["id"],
                    ]);
                    $selectReportCom = $selectReportCom->fetch(PDO::FETCH_NUM);
                    ?>
                    <div class="sending">
                        <div class="users">
                            <?php
                            $query = $db->prepare(
                              "SELECT pseudo FROM USER WHERE id = :id_user"
                            );
                            $query->execute([
                              "id_user" => $message["id_user"],
                            ]);
                            $selectUser = $query->fetch(PDO::FETCH_ASSOC);
                            ?>

                                <tbody>
                                    <tr>
                                        <?php if (
                                          $_SESSION["id"] == $message["id_user"]
                                        ) { ?>
                                            <td>Vous</td>
                                        <?php } else { ?>
                                        <td><?= $selectUser["pseudo"] ?></td>
                                        <?php } ?>
                                        <td><?= banword("../banlist.txt", $message["message"]) ?></td>
                                        <td id="date_send"><?= $message[
                                          "date_send"
                                        ] ?></td>
                                        <?php if (
                                            isset($_SESSION["id"]) &&
                                            $selectReportCom[0] == 0
                                        ) { ?>
                                        <td>

                                          <a href="../admin/comment/report_comment.php?name_recipe=<?= $select[
                                            "name"
                                          ] ?>&id_comment=<?= $message[
  "id"
] ?>&id_recipe=<?= htmlspecialchars($_GET["id"]) ?>" 
                                          class="btn btn-danger">Signaler</a></td>

                                        </td>

                                        <?php } ?>
                                        <?php if (isset($_SESSION["id"])) { ?>
                                        <td>
                                        <?php if (
                                          $_SESSION["rights"] == 1 ||
                                          $resultUserCreateRecipe["id_user"] ==
                                            $_SESSION["id"]
                                        ) { ?>
                                          <a href="../admin/comment/delete_comment.php?name_recipe=<?= $select[
                                            "name"
                                          ] ?>&id_comment=<?= $message[
  "id"
] ?>&id_user=<?= $message["id_user"] ?>&id_recipe=<?= htmlspecialchars(
  $_GET["id"]
) ?>" class="btn btn-ban">Supprimer</a></td>

                                    <?php } ?>
                                   
                                      
                                      <?php } ?>
                                    </tr>
                                </tbody>


                        </div>

                    </div>

                        <?php }
                    ?>
                </table>
                </div>
                </div>

        </main>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/addFavorite.js"></script>
    <?php include "../includes/scripts.php"; ?>
</body>
</html>  