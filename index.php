<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "TopCook - Accueil";
include "includes/head.php";
include "includes/db.php";
include "includes/functions.php";
?>
<body>
    <?php include "includes/header.php"; ?>
    <main>
      <div class="container col-md-6">
      <?php include "includes/message.php"; ?>
      </div>
        <?php
        $selectRecipe = $db->prepare(
          "SELECT name, images, id, description FROM RECIPE WHERE name = :name"
        );
        $selectRecipe->execute([
          "name" => moreViewsRecipe(),
        ]);
        $result = $selectRecipe->fetch();
        $recipeName = $result["name"];
        $recipeImage = $result["images"];
        $recipeId = $result["id"];
        $recipeDescription = $result["description"];
        ?>
      <h1 class="pb-3 text-center"><strong>La recette la plus visité</strong></h1>
        <a href="recipes/recipe.php?id=<?= $recipeId ?>&name=<?= $recipeName ?>" class="text-dark text-decoration-none link_recipe_moment">
    <div class="card mb-3 me-5 ms-5 recipe_moment">
      <div class="row g-0">

        <div class="col-md-2">
            <?= '<img src="uploads/recipe/' .
              $recipeImage .
              '"class="img-fluid rounded-start" alt=image -' .
              $recipeName .
              '">' ?>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h2 class="card-title text-center mb-4"><strong><?= $recipeName ?></strong></h2>
            <p class="card-text fs-3 ms-5 me-5"><?= $recipeDescription ?></p>
          </div>
        </div>

      </div>
    </div>
  </a>
            <h3 class="pb-4 pt-5"><strong>Top recettes du mois</strong></h3>

                <div class="last_recipe row row-col-md-4 me-5 ms-5 mt-3 mb-3">
   <?php
   $query = $db->query(
       "SELECT id_user FROM RECIPE ORDER BY id DESC"
   );
   $result = $query->fetch(PDO::FETCH_ASSOC);
   $id_creator_recipe = $result["id_user"];

   $array = topLikesRecipesMonth();
   foreach ($array as $key => $value){
       $nameRecipeMonth = explode(".txt", $key);
       $nameRecipeMonth = $nameRecipeMonth[0];
       $recipeMonth = $db->prepare(
           "SELECT id, name, images, description FROM RECIPE WHERE name = :name"
       );
       $recipeMonth->execute([
           "name" => $nameRecipeMonth,
       ]);
       $resultMonth = $recipeMonth->fetchAll(PDO::FETCH_ASSOC);
       foreach ($resultMonth as $selectMonth){
           $recipeIdMonth = $selectMonth["id"];
           $recipeNameMonth = $selectMonth["name"];
           $recipeImageMonth = $selectMonth["images"];
           $recipeDescriptionMonth = $selectMonth["description"];

               $selectCreatorRecipe = $db->query("SELECT pseudo FROM USER WHERE id = ".$id_creator_recipe);

               $resultCreatorRecipe = $selectCreatorRecipe->fetch(PDO::FETCH_ASSOC);
               $creatorRecipe = $resultCreatorRecipe['pseudo'];

   ?>

                    <div class="col-md-3">

                    <div class="card recipe" style="width: 100%;">
                        <?= '<img src="uploads/recipe/' .
                        $recipeImageMonth .
                        '"height="380" class="card-img-top" alt=image -' .
                        $recipeNameMonth .
                        '">' ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= $recipeNameMonth ?> par <em><strong><?= $creatorRecipe ?></strong></em></h5>
                            <p class="card-text col-12 text-truncate"><?= $recipeDescriptionMonth ?></p>
                            <a href="recipes/recipe.php?id=<?= $recipeIdMonth ?>&name=<?= $recipeNameMonth ?>" class="btn see_more">Voir d'avantage</a>
                        </div>
                    </div>
                    </div>
            <?php }} ?>

        </div>
            <div class="container pt-4">
                <div class="d-grid gap-2 col-2 mx-auto">
                    <a href="https://topcook.site/toutes-nos-recettes" class="btn" type="button" id="see_more_btn">Voir plus...</a>
                </div>
            </div>
      
        <?php

        $query = $db->query(
            "SELECT id, name, images, description FROM RECIPE ORDER BY id DESC"
        );
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        ?>
   
      <h3 class="pt-5 pb-3"><strong>Dernières recettes publiées</strong></h3>
      <div class="last_recipe row row-col-md-4 me-5 ms-5 mt-3 mb-3">
      <?php foreach (array_slice($result, 0, 3) as $select) {


          ?>
          <div class="col-md-3">
            <div class="card recipe" style="width: 100%;">
            <?= '<img src="uploads/recipe/' .
              $select["images"] .
              '"height="380" class="card-img-top" alt=image -' .
              $select["names"] .
              '">' ?>
              <div class="card-body">
                <h5 class="card-title"><?= $select["name"] ?> par <em><strong><?= $creatorRecipe ?></strong></em></h5>
                <p class="card-text col-12 text-truncate"><?= $select[
                  "description"
                ] ?></p>
                <a href="recipes/recipe.php?id=<?= $select[
                  "id"
                ] ?>&name=<?= $select[
  "name"
] ?>" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
      <?php } ?>
        </div>

        <div class="container pt-4">
            <div class="d-grid gap-2 col-2 mx-auto">
                <a href="https://topcook.site/toutes-nos-recettes" class="btn" type="button" id="see_more_btn">Voir plus...</a>
            </div>
        </div>


      <h3 class="pt-5 pb-3"><strong>Derniers Topics publiées</strong></h3>
      <div class="container pb-5">
          <?php
          $selectLastTopic = $db->query(
            "SELECT id, subject, date, id_user FROM TOPIC ORDER BY id DESC LIMIT 5"
          );
          $resultLastTopic = $selectLastTopic->fetchAll(PDO::FETCH_ASSOC);
          ?>
        <table class="table table-bordered table-hover">
            <thead class="text-center">
            <tr>
                <th scope="col">Créateur</th>
                <th scope="col">Sujet</th>
                <th scope="col">Date de création</th>
                
            </tr>
            </thead>
            <?php foreach ($resultLastTopic as $lastTopic) {

              $subjectTopic = $lastTopic["subject"];
              $dateTopic = $lastTopic["date"];
              $idTopic = $lastTopic["id"];
              $idUser = $lastTopic["id_user"];
              $selectCreator = $db->query(
                "SELECT pseudo FROM USER WHERE id = '$lastTopic[id_user]'"
              );
              $resultCreator = $selectCreator->fetch(PDO::FETCH_ASSOC);
              $creator = $resultCreator["pseudo"];
              ?>

          <tbody>
            <tr>
              <td><?= $creator ?></td>
              <td><a href="https://topcook.site/forum/subject.php?id_subject=<?= $idTopic ?>&creator=<?= $creator ?>&id_creator=<?= $idUser ?>"><?= $subjectTopic ?></a></td>
              <td><?= $dateTopic ?></td>
            </tr>
          </tbody>
            <?php
            } ?>
        </table>
      </div>

      <div class="d-flex justify-content-center competition pb-5">
        <h1 class="align-self-center pe-5"><strong>Concours en cours</strong></h1>
        <a href=""><img src="https://braindegeek.com/wp-content/uploads/2016/11/concours.png"  class="" width="100%" height="250"></a>
      </div>
    </main>

    <?php include "includes/footer.php"; ?>

    <?php
    include "includes/scripts.php";
    ?>
  </body>
</html>
