<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "TopCook - Accueil";
include "includes/head.php";
include "includes/db.php";
if (isset($_SESSION["id"])) {
  $date = date("d/m/Y H:i:s");
  $log_visit = fopen("log/log_index.txt", "a+");
  fputs($log_visit, "Visite de index le :");
  fputs($log_visit, $date);
  fputs($log_visit, " par ");
  fputs($log_visit, $_SESSION["id"]);
  fputs($log_visit, "\n");
  fclose($log_visit);
}
?>
<body>
    <?php include "includes/header.php"; ?>
    <main>
      <div class="container col-md-6">
      <?php include "includes/message.php"; ?>
      </div>
      <h1 class="pb-3 text-center"><strong>La recette du moment</strong></h1>
    <div class="card mb-3 me-5 ms-5 recipe_moment"> <!-- Recette du moment -->
      <div class="row g-0">
        <div class="col-md-4">
          <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h2 class="card-title text-center"><strong>Sushi</strong></h2>
            <p class="card-text fs-3 ms-5 me-5">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>
    </div>
      <h3 class="pb-4 pt-5"><strong>Top recettes du mois</strong></h3>
      <div class="best_recipe row row-col-md-4 me-5 ms-5">
          <div class="col">
            <div class="card recipe" style="width: 100%;">
              <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="card-img-top" alt="">

              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="#" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card recipe" style="width: 100%;">
              <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="card-img-top" alt="">

              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="#" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card recipe" style="width: 100%;">
              <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="card-img-top" alt="">

              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="#" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card recipe" style="width: 100%;">
              <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="card-img-top" alt="">

              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <a href="#" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
        </div>
        <div class="container pt-4">
          <div class="d-grid gap-2 col-2 mx-auto">
            <button class="btn" type="button" id="see_more_btn"><div>Voir plus...</div></button>
          </div>
        </div>
      
        <?php 
        $query = $db->query(
            "SELECT id, name, images, description FROM RECIPE ORDER BY id DESC"
        );
        $result = $query->fetchAll(PDO::FETCH_ASSOC);?>
   
      <h3 class="pt-5 pb-3"><strong>Dernières recettes publiées</strong></h3>
      <div class="last_recipe row row-col-md-4 me-5 ms-5 mt-3 mb-3">
      <?php foreach (array_slice($result, 0 , 3) as $select) { ?>
          <div class="col-md-3">
            <div class="card recipe" style="width: 100%;">
            <?= '<img src="uploads/recipe/' . $select["images"] . '" class="card-img-top" alt=image -' . $select['names'] . '">'; ?>
              <div class="card-body">
                <h5 class="card-title"><?= $select['name']?></h5>
                <p class="card-text"><?= $select['description'] ?></p>
                <a href="recipes/recipe.php?id=<?=$select['id']?>&name=<?=$select['name']?>" class="btn see_more">Voir d'avantage</a>
              </div>
            </div>
          </div>
        </div>
        <?php }  ?>
        <div class="container pt-4">
            <div class="d-grid gap-2 col-2 mx-auto">
                <button class="btn" type="button" id="see_more_btn"><div>Voir plus...</div></button>
            </div>
        </div>


      <h3 class="pt-5 pb-3"><strong>Derniers Topics publiées</strong></h3>
      <div class="container pb-5">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Créateur</th>
              <th scope="col">Sujet</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dan</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <td>Larry the Bird</td>
              <td>Dan le boss</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-center competition pb-5">
        <h1 class="align-self-center pe-5"><strong>Concours en cours</strong></h1>
        <a href=""><img src="https://braindegeek.com/wp-content/uploads/2016/11/concours.png"  class="" width="100%" height="250"></a>
      </div>
    </main>

    <?php include "includes/footer.php"; ?>
    
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>
