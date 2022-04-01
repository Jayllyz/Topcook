<?php
session_start();
include "includes/db.php";
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "images/topcook_logo.svg";
$linkCss = "css/style.css";
$title = "Recettes";
include "includes/head.php";
if(isset($_SESSION["id"])) {
    $date = date("d/m/Y H:i:s");
    $log_visit = fopen("log/log_recettes.txt", "a+");
    fputs($log_visit, "Visite de recettes le :");
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
        <h1 class="pb-3 text-center"><strong>Toutes nos recettes</strong></h1>
      <?php if(isset($_SESSION["id"])) { ?>
              <div class="add-recipe">
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Ajouter une recette
                  </button>
              </div>

      <?php }; ?>

    <div class="container g-1" id="recettes">
        <div class="pb-4 row justify-content-md-center">
            <div class=" col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
            <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
        </div>

        <div class="pb-4 row justify-content-md-center">    
            <div class=" col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
        </div>

        <div class="pb-4 row justify-content-md-center">
            <div class=" col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >  
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
        </div>

        <div class="pb-4 row justify-content-md-center">
            <div class=" col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
            <div class="col col-md-3">
                <img src="https://www.tourisme-rennes.com/uploads/2019/06/Bouffes-rennaises.jpg" class="rounded img-fluid" alt="..." >
                <h4 class="text-center">Sushi</h4>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une recette</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="verifications/add_recette.php" method="post" enctype="multipart/form-data">
                <div class="container col-md-10">
                    <label class="form-label">Nom de la recette</label>
                    <input type="text" name="nom" class="form-control"  required>

                    <label class="form-label">Temps de préparation (minutes)</label>
                    <input type="number" name="time_prep" class="form-control"  required>

                    <label class="form-label">Temps de cuisson (minutes)</label>
                    <input type="number" name="time_cook" class="form-control"  required>

                    <label class="form-label">Nombre de personne</label>
                    <input type="number" name="number" class="form-control"  required>

                    <div class="steps">
                        <div>
                            <label class="form-label">Etapes
                        </div>
                        <div class="logo-add-remove-recipe">
                            <button class="btn plus" onclick="addRecipe()"><img src="images/plus-lg.svg"></button>
                            <button class="btn dash" onclick="removeRecipe()"> <img src="images/dash-lg.svg"></button>
                        </div>
                        </label>
                    </div>
                    <input type="text" name="steps" class="form-control steps-input" placeholder="Etape 1"  required>
                    <div id="new-steps"></div>

                    <label class="form-label">Photo de la recette</label>
                    <input type="file" name="image" class="form-control is-<?= isset(
                      $_GET["valid"]
                    ) && $_GET["input"] == "fichier"
                      ? $_GET["valid"]
                      : "" ?>" accept="image/png, image/jpeg">

                    <label class="form-label">Type de recette</label>
                    <input type="text" name="type" class="form-control" required>
                
                    <button type="submit" name="submit" class="btn mt-3" data-bs-dismiss="modal">Envoyer</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    </main>
    <?php include "includes/footer.php"; ?>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>