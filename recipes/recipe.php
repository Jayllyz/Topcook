<?php
session_start();
include "../includes/db.php";
include "../includes/functions.php";
if (isset($_GET["nbSteps"])) {
  $nbSteps = htmlspecialchars($_GET["nbSteps"]);
}
$name = htmlspecialchars($_GET["name"]);
$date = date("d/m/Y H:i:s");
$idLog = htmlspecialchars($_GET["id"]);
$log_recipe = fopen("../log/recipe_logs/$idLog.txt", "a+");
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
$title = "Topcook - " . $name;
include "../includes/head.php";
?>

<body onload="countLikeParticipate(<?= $_GET["id"] ?>)">

  <?php include "../includes/header.php"; ?>
  <main>
    <div class="container col-md-6">
      <?php include "../includes/message.php"; ?>
    </div>
    <?php
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
          $select["name"] .
          '"></a>' ?>
        <div class="div-head-recipe">
          <div class="head-recipe">
            <p>Nom : <span><?= "<strong>" .
                              $_GET["name"] .
                              "</strong></span>" ?>
                <div class="nb_pers">
                  <div>
                    <label class="form-label">Nombres de personnes: <span id="pers"><?= $select["nb_persons"] ?></span>
                  </div>
                  <div class="logo-add-remove-persons">
                    <img src="../images/plus-lg.svg" onclick="addPers()">
                    <img src="../images/dash-lg.svg" onclick="removePers()">
                  </div>
                </div>
            </p>
          </div>
        </div>
        <?php if (isset($_SESSION["id"])) {

          $selectFavorite = $db->query(
            "SELECT idUser, idRecipe FROM FAVORITE_RECIPE WHERE idUser = " .
              $_SESSION["id"] .
              " AND idRecipe = " .
              $_GET["id"]
          );
          $favorite = $selectFavorite->fetch(PDO::FETCH_ASSOC);
          $favorite["idUser"] = isset($favorite["idUser"]) ? $favorite["idUser"] : null;
          $favorite["idRecipe"] = isset($favorite["idRecipe"]) ? $favorite["idUser"] : null;
          $idUserFavorite = $favorite["idUser"];
          $idRecipeFavorite = $favorite["idRecipe"];
        ?>
          <div id="favorite">
            <button class="btn mb-3 <?= $idUserFavorite !==
                                      $_SESSION["id"]
                                      ? ""
                                      : "btn-ban" ?>" id="add_favorite" onclick="addFavorite(<?= $select["id"] ?>)"><?= $idUserFavorite !== $_SESSION["id"]
                                                                                                                      ? "Ajouter aux favoris"
                                                                                                                      : "Retirer des favoris" ?></button>
          </div>

        <?php
        } ?>
        <div id="result_favorite"></div>
        <p><?= "Description : " . $select["description"] ?></p>
        <p><?= "Preparation : " . $select["time_prep"] ?> min</p>
        <p><?= "Cuisson : " . $select["time_cooking"] ?> min</p>
        <p><?= "Type : " . $select["type"] ?></p>

        <div class="d-flex flex-row">
          <div id="like">
            <?php if (isset($_SESSION["id"])) {

              $selectIdUserIfLike = $db->query(
                "SELECT id_user FROM LIKES WHERE id_user = " .
                  $_SESSION["id"] .
                  " AND id_recipe = " .
                  $_GET["id"]
              );
              $idUserIfLike = $selectIdUserIfLike->fetch(
                PDO::FETCH_ASSOC
              );
              $idUserIfLike["id_user"] = isset($idUserIfLike["id_user"]) ? $idUserIfLike["id_user"] : "";
              $idUserIfLike = $idUserIfLike["id_user"];
            ?>
              <img src="../images/like.svg" id="isLiked" alt="like" width="30" class="<?= $idUserIfLike ==
                                                                                        $_SESSION["id"]
                                                                                        ? "liked"
                                                                                        : "" ?>" height="30" onclick="like(<?= $select["id"] ?>)">
            <?php
            } else {
            ?>
              <img src="../images/like.svg" alt="like" width="30" class="notLiked" height="30" onclick="errorLike()">
            <?php
            } ?>
          </div>
          <p class="ps-3 fs-4" id="result_like"></p>

        </div>
        <div id="error_like"></div>


        <?php if (
          isset($_SESSION["id"]) &&
          isset($_SESSION['rights'])
        ) {
          if ($_SESSION["rights"] == 1 || $_SESSION["id"] == $select["id_user"]) {
        ?>
            <div class="btn_ingredients mb-4">
              <a href="deleteRecipe.php?id=<?= $select["id"] ?>&id_user=<?= $select["id_user"] ?>&name=<?= $select["name"] ?>" onclick="return checkConfirm('Voulez vous vraiment supprimer cette recette?')" class="btn btn-danger">
                Supprimer la recette
              </a>
            </div>
        <?php }
        } ?>

        <div class="list_ingredient">
          <h3>Ingrédients</h3>

          <?php
          $selectIngredients = $db->prepare(
            "SELECT name, quantity, unit FROM INGREDIENT WHERE id_recipe = :id_recipe"
          );
          $countNbIngredients = $db->prepare("SELECT COUNT(id_recipe) as nbIngredients FROM INGREDIENT WHERE id_recipe = :id_recipe GROUP BY id_recipe");
          $countNbIngredients->execute([
            "id_recipe" => $_GET["id"]
          ]);

          $nbIngredients = $countNbIngredients->fetch(PDO::FETCH_ASSOC);
          $nbIngredients = $nbIngredients["nbIngredients"];
          $selectIngredients->execute([
            "id_recipe" => $select["id"],
          ]);
          $resultIngredients = $selectIngredients->fetchAll(
            PDO::FETCH_ASSOC
          );
          ?>
          <?php if (
            isset($_SESSION["id"]) &&
            isset($_SESSION['rights'])
          ) {
            if ($_SESSION["rights"] == 1 || $_SESSION["id"] == $select["id_user"]) {
          ?>
              <div class="btn_ingredients mb-4">
                <a href="https://topcook.site/recipes/modifyIngredients.php?name=<?= $select["name"] ?>&id=<?= $select["id"] ?>&nbIngredients=<?= $nbIngredients ?>" class="btn">
                  Ajouter des ingrédients
                </a>
              </div>
          <?php }
          } ?>
          <?php foreach ($resultIngredients as $ingredient) {
          ?>
            <div class="info_ingredients">

              <p class="name_ingredient"><?= $ingredient["name"] ?></p>
              <span>
                <p class="quantity"><?= $ingredient["quantity"] ?></p><strong><?= $ingredient["unit"] ?></strong>
              </span>
            </div>
          <?php } ?>

        </div>
        <div class="list_steps">
          <h3>Préparation</h3>
          <?php if (
            isset($_SESSION["id"]) &&
            isset($_SESSION['rights'])
          ) {
            if ($_SESSION["rights"] == 1 || $_SESSION["id"] == $select["id_user"]) {
          ?>
              <div class="btn_ingredients mb-4">
                <a href="ingredients.php?name=<?= $select["name"] ?>&id=<?= $select["id"] ?>&nbSteps=<?= $nbSteps ?>" class="btn">
                  Modifier les étapes
                </a>
              </div>
          <?php }
          } ?>
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
        if (isset($_SESSION["id"])) {
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
              <a href="reportRecipe.php?id=<?= $select["id"] ?>&id_user=<?= $select["id_user"] ?>&name=<?= $select["name"] ?>" onclick="return checkConfirm('Voulez vous vraiment signaler cette recette?')" class="btn btn-danger">
                Signaler la recette
              </a>
            </div>
        <?php }
        } ?>


        <div class="commentaires">
          <h3>Commentaires</h3>
          <form action="commentaires.php?id_recipe=<?= htmlspecialchars(
                                                      $_GET["id"]
                                                    ) ?>&name=<?= $select["name"] ?>" method="post">
            <label class="form-label">Saisir un commentaire</label>
            <textarea name="comment" class="form-control mb-3" id="comment"></textarea>
            <input type="submit" class="form-control btn btn-success mb-3" name="submit" value="Commenter">
          </form>
        </div>
        <div class="messages mt-5 mb-5">
          <table id="com" class="table text-center table-bordered table-hover">
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
                  <th id="th-report">Signaler</th>
                <?php } ?>

                <?php
                if (isset($_SESSION["id"])) {
                  $selectIdUserRecipeMsg = $db->prepare(
                    "SELECT COUNT(id) FROM COMMENTAIRE WHERE id_recipe = :id_recipe AND id_user = :id_user"
                  );
                  $selectIdUserRecipeMsg->execute([
                    "id_recipe" => htmlspecialchars($_GET["id"]),
                    "id_user" => $_SESSION["id"],
                  ]);
                  $resultIdUserRecipeMsg = $selectIdUserRecipeMsg->fetch(
                    PDO::FETCH_NUM
                  );

                  if (
                    $_SESSION["rights"] == 1 ||
                    $resultUserCreateRecipe["id_user"] == $_SESSION["id"] ||
                    $resultIdUserRecipeMsg[0] > 0
                  ) { ?>
                    <th>Supprimer</th>
                  <?php }
                  ?>

              <?php }
              }
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
              if (isset($_SESSION["id"])) {
                $selectReportCom = $db->prepare(
                  "SELECT count(id) FROM REPORT_COM WHERE id_user = :id_user AND id_comment = :id_comment"
                );
                $selectReportCom->execute([
                  "id_user" => $_SESSION["id"],
                  "id_comment" => $message["id"],
                ]);
                $selectReportCom = $selectReportCom->fetch(PDO::FETCH_NUM);
              }
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
                        isset($_SESSION['id']) &&
                        $_SESSION["id"] == $message["id_user"]
                      ) { ?>
                        <td>Vous</td>
                      <?php } else { ?>
                        <td><?= $selectUser["pseudo"] ?></td>
                      <?php } ?>
                      <td><?= banword(
                            "../banlist.txt",
                            $message["message"],
                            $db,
                            0
                          ) ?></td>
                      <td id="date_send"><?= $message["date_send"] ?></td>

                      <?php if (
                        isset($_SESSION["id"]) &&
                        $selectReportCom[0] == 0 &&
                        $_SESSION["id"] !==
                        $message["id_user"]
                      ) { ?>
                        <td>
                          <a href="../admin/comment/report_comment.php?name_recipe=<?= $select["name"] ?>&id_comment=<?= $message["id"] ?>&id_recipe=<?= htmlspecialchars($_GET["id"]) ?>" class="btn btn-danger" id="report-btn">Signaler</a>
                        </td>
                        </td>

                        <?php } else {
                        if (isset($_SESSION['id']) && $_SESSION["id"]) { ?>
                          <td>
                            <a href="#"></a>
                          </td>
                      <?php }
                      } ?>
                      <?php if (isset($_SESSION['id']) && isset($_SESSION["id"])) {
                        if ($_SESSION["rights"] == 1 || $message["id_user"] == $_SESSION["id"]) {
                      ?>
                          <td>
                            <a href="../admin/comment/delete_comment.php?name_recipe=<?= $select["name"] ?>&id_comment=<?= $message["id"] ?>&id_user=<?= $message["id_user"] ?>&id_recipe=<?= htmlspecialchars(
                                                                                                                                                                                            $_GET["id"]
                                                                                                                                                                                          ) ?>" id="delete-btn" class="btn btn-ban">Supprimer</a>
                          </td>

                      <?php }
                      } ?>
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
  <script>
    const reportBtn = document.getElementById("report-btn");
    let table = document.getElementById("com").rows;
    if (typeof reportBtn === 'undefined' || reportBtn === null) {
      let i = 3;
      for (let j = 0; j < table.length; j++) {
        table[j].deleteCell(i);
      }
    }
  </script>
  <script src="../js/likes.js"></script>
  <?php include "../includes/footer.php"; ?>
  <script src="../js/addFavorite.js"></script>
  <?php include "../includes/scripts.php"; ?>
</body>

</html>