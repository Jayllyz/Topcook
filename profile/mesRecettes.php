<?php session_start();
include "../includes/db.php";

if (isset($_SESSION["id"])) { ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "TopCook - Mes recettes";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <h1 class="pb-3 text-center">Mes recettes</h1>

        <?php
        $query = $db->prepare(
            "SELECT name, images FROM RECIPE WHERE id_user = :id_user ORDER BY id DESC"
        );
        $query->execute([
            "id_user" => $_SESSION["id"]
        ]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container g-1" id="recettes">
            <div class="pb-4 row justify-content-md-center">
                <?php foreach ($result as $select) { ?>

                    <div class=" col col-md-3">
                        <?= '<img src="../uploads/recipe/' . $select["images"] . '" class="rounded img-fluid" alt="image -' . $select['names'] . '">'; ?>
                        <h4 class="text-center"><?= $select['name'] ?></h4>
                    </div>


                <?php } ?>
            </div>
        </div>
    </main>
    <?php include "../includes/footer.php"; ?>
    <script src="../js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
<?php } else {header("location: ../index.php");
  exit();} ?>
