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
    </main>
    <?php include "includes/footer.php"; ?>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>