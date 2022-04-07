<?php
session_start();
include "../includes/db.php";
$nbSteps = htmlspecialchars($_GET["nbSteps"]);
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
        <div class="container col-md-6">
            <?php include "../includes/message.php"; ?>
        </div>
            <?php
            $query = $db->prepare(
              "SELECT id, name, images, description, time_prep, time_cooking, nb_persons, type, votes, id_user FROM RECIPE WHERE id = :id"
            );
            $query->execute([
              "id" => htmlspecialchars($_GET["id"]),
            ]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $select) { ?>
            <div class="container col-md-6 shadow-lg recipe-page">
                <?= '<img src="../uploads/recipe/' .
                  $select["images"] .
                  '" class="rounded img-fluid" alt="image -' .
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
                            </label>
                        </div>
                        </p>
                    </div>
                </div>


                <p><?= "Description :" . $select["description"] ?></p>
                <p><?= "Preparation :" . $select["time_prep"] ?></p>
                <p><?= "Cuisine :" . $select["time_cooking"] ?></p>
                <p><?= "Type :" . $select["type"] ?></p>
                <p><?= "Votes :" . $select["votes"] ?></p>
                <div class="list_ingredient">
                    <h3>Ingrédients</h3> 
                    <?php if ($_SESSION["rights"] == 1) { ?>
                        <div class="btn_ingredients mb-4">
                            <a href="ingredients.php?name=<?=
                  $select["name"]?>&id=<?=$select['id']?>&nbSteps=<?=$nbSteps?>" class="btn">
                                Modifier les ingrédients
                            </a>
                        </div>
                    <?php } ?>
                    <?php
                    $selectIngredients = $db->prepare(
                      "SELECT name, quantity FROM INGREDIENT WHERE id_recipe = :id_recipe"
                    );
                    $selectIngredients->execute([
                      "id_recipe" => $select["id"],
                    ]);
                    $resultIngredients = $selectIngredients->fetchAll(PDO::FETCH_ASSOC);?>

                        <?php foreach ($resultIngredients as $ingredient) {
                        ?>
                            <div class="info_ingredients">

                        <p class="name_ingredient"><?= $ingredient['name']?></p>
                        <p class="quantity"><?= $ingredient['quantity']?></p>
                    </div>
                        <?php  } ?>

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
                <div class="commentaires">
                    <h3>Commentaires</h3>
                    <form action="commentaires.php?id_recipe=<?=htmlspecialchars($_GET['id'])?>&name=<?=$select['name']?>" method="post">
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
                $resultUserCreateRecipe = $selectUserCreateRecipe->fetch(PDO::FETCH_ASSOC);

                ?>
                <tr>
                    <th>Pseudo</th>
                    <th>Message</th>
                    <th>Date</th>
                    <?php
                    if($_SESSION["rights"] == 1 || $resultUserCreateRecipe["id_user"] == $_SESSION["id"]){

                  ?>
                    <th>Supprimer</th>
                          <?php } ?>
                    <?php
                    }?>
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
                    foreach ($selectMessages as $message) {
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
                                        <?php
                                        if($_SESSION['id'] == $message['id_user']){
                                            ?>
                                            <td>Vous</td>
                                        <?php }else{ ?>
                                        <td><?= $selectUser["pseudo"] ?></td>
                                        <?php } ?>
                                        <td><?= $message["message"] ?></td>
                                        <td id="date_send"><?= $message["date_send"] ?></td>
                                        <?php
                                        if($_SESSION["rights"] == 1 || $resultUserCreateRecipe["id_user"] == $_SESSION["id"]){
                                        ?>
                                        <td><a href="../admin/comment/delete_comment.php?name_recipe=<?=$select["name"]?>&id_comment=<?= $message["id"] ?>&id_user=<?= $message["id_user"] ?>&id_recipe=<?= htmlspecialchars($_GET["id"]) ?>" class="btn btn-ban">Supprimer</a></td>
                                        <?php
                                        }?>
                                    </tr>
                                </tbody>


                        </div>

                    </div>

                        <?php
                    }
                    ?>
                </table>
                </div>
                </div>

        </main>
    <?php include "../includes/footer.php"; ?>

    <script src="../js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>  