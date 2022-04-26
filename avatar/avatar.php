<?php
session_start();
$idUser = $_SESSION['id'];
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include '../includes/db.php';
include '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Création d'avatar";
include "../includes/head.php";
?>
<body>

<?php include "../includes/header.php"; ?>
<main>
<div class="avatar">
    <!--- SVG corps -->
    <div id="parent">
        <div id="corps">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="body" fill="#F5CDD3" fill-rule="evenodd"
                      d="M290.963 248.235a80 80 0 0 0-44.227-31.543L204.999 205v-29.999c17.644-13.254 29.231-34.111 29.943-57.704A19.922 19.922 0 0 0 243 119c11.045 0 20-8.954 20-20s-8.955-20-20-20c-2.847 0-5.549.603-8 1.675V75c0-41.422-33.579-75-75-75h-.001C118.578 0 85 33.578 85 75v5.675A19.914 19.914 0 0 0 77 79c-11.046 0-20 8.954-20 20s8.954 20 20 20c2.869 0 5.591-.615 8.058-1.703.711 23.593 12.298 44.45 29.941 57.704V205l-41.736 11.692a80 80 0 0 0-44.227 31.543L0 290.24V320h320v-29.76l-29.037-42.005Z"
                      clip-rule="evenodd"/>
                <path stroke="#00004D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M87.609 101.918c.255-.929.392-1.908.392-2.918 0-6.075-4.925-11-11-11-1.52 0-2.966.308-4.282.865M232.391 101.918A11.012 11.012 0 0 1 232 99c0-6.075 4.925-11 11-11 1.518 0 2.965.308 4.282.865"/>
            </svg>

        </div>
        <div id="hat">
            <?php $selectImgHat = getAvatar($db,'hat', $idUser); ?>
            <?php if( $selectImgHat !== FALSE){
                        echo $selectImgHat;
            }?>
        </div>

        <div id="yeux">
            <?php $selectImgEyes = getAvatar($db,'eyes', $idUser); ?>
            <?php if( $selectImgEyes !== FALSE){
                        echo $selectImgEyes;
            }?>
        </div>

        <div id="bouche">
            <?php $selectImgMouth = getAvatar($db,'mouth', $idUser); ?>
            <?php if( $selectImgMouth !== FALSE){
                        echo $selectImgMouth;
            }?>
        </div>


        <div id="cheveux">
            <?php $selectImgHair = getAvatar($db,'hair', $idUser); ?>
            <?php if( $selectImgHair !== FALSE){
                        echo $selectImgHair;
            }?>
        </div>

        <div id="barbe">
            <?php $selectImgBeard = getAvatar($db,'beard', $idUser); ?>
            <?php if( $selectImgBeard !== FALSE){
                        echo $selectImgBeard;
            }?>
        </div>

        <div id="vetement">
            <?php $selectImgSweat = getAvatar($db,'sweat', $idUser); ?>
            <?php if( $selectImgSweat !== FALSE){
                        echo $selectImgSweat;
            }?>
        </div>

    </div>
    <div class="container g-1">
        <div class="sort mb-4 mt-4">
            <label>Selectionner un type d'accessoire : </label>
            <select name="type" id="selectedTypeAccessories" class="form-control" onchange="changeTypeAccessories()">
                <option value="HAIR">Cheveux</option>
                <option value="MOUTH">Bouche</option>
                <option value="HAT">Chapeau</option>
                <option value="BEARD">Barbe</option>
                <option value="EYES">Yeux</option>
                <option value="SWEAT">Vetement</option>
            </select>
        </div>
    </div>
    <div class="container">
    <div id="viewSelectedElement" class="d-flex flex-wrap justify-content-center"></div>
    </div>
    <div class="container">
        <div class="chooseElement" id="chooseElement">
            <h2 class="mt-3 mb-3">Yeux</h2>
            <div id="eyes-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultEyes = viewElement($db,'EYES');
                foreach ($resultEyes as $eyes){
                ?>
                <div class="eyes-presentation-element col-md-3 accessories me-1 mb-2">
                    <?= $eyes['image']; ?>
                    <button class="btn btn-primary" id="<?= $eyes['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                </div>
                <?php } ?>
            </div>
            <h2 class="mt-3 mb-3">Chapeau</h2>
            <div id="hat-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultHat = viewElement($db,'HAT');
                foreach ($resultHat as $hat){
                    ?>
                    <div class="hat-presentation-element col-md-3 accessories me-1 mb-2"">
                        <?= $hat['image']; ?>
                        <button class="btn btn-primary" id="<?= $hat['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                    </div>
                <?php } ?>
            </div>
            <h2 class="mt-3 mb-3">Barbe</h2>
            <div id="beard-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultBeard = viewElement($db,'BEARD');
                foreach ($resultBeard as $beard){
                    ?>
                    <div class="beard-presentation-element col-md-3 accessories me-1 mb-2"">
                        <?= $beard['image']; ?>
                        <button class="btn btn-primary" id="<?= $beard['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                    </div>
                <?php } ?>
            </div>
            <h2 class="mt-3 mb-3">Bouche</h2>
            <div id="mouth-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultMouth = viewElement($db,'MOUTH');
                foreach ($resultMouth as $mouth){
                    ?>
                    <div class="mouth-presentation-element col-md-3 accessories me-1 mb-2"">
                        <?= $mouth['image']; ?>
                        <button class="btn btn-primary" id="<?= $mouth['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                    </div>
                <?php } ?>
            </div>
            <h2 class="mt-3 mb-3">Vetement</h2>
            <div id="sweat-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultSweat = viewElement($db,'SWEAT');
                foreach ($resultSweat as $sweat){
                    ?>
                    <div class="sweat-presentation-element col-md-3 accessories me-1 mb-2"">
                        <?= $sweat['image']; ?>
                        <button class="btn btn-primary" id="<?= $sweat['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                    </div>
                <?php } ?>
            </div>
            <h2 class="mt-3 mb-3">Cheveux</h2>
            <div id="hair-presentation" class="d-flex flex-wrap justify-content-center">

                <?php
                $resultHair = viewElement($db,'HAIR');
                foreach ($resultHair as $hair){
                    ?>
                    <div class="hair-presentation-element col-md-3 accessories me-1 mb-2">
                        <?= $hair['image']; ?>
                        <button class="btn btn-primary" id="<?= $hair['id']; ?>" onclick="addElement(this.id)">Ajouter</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="container pt-4">
        <div class="select">
        <!-- form envoie de l'image -->
            <label>Couleur du corps</label>
            <select name="body" id="test" onchange="changeCorps()" class="form-control">
                <option value="#F5CDD3" style="background-image: url('../images/topcook_logo.svg')">Beige</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>
            <label class="mt-3">Couleur des yeux</label>
            <select name="eyes" id="test2" onchange="changeEyes()" class="form-control">
                <option value="#00004D">Bleu foncé</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>
            <label class="mt-3">Couleur du chapeau</label>
            <select name="hat" id="test3" onchange="changeHat()" class="form-control">
                <option value="#2384F5">Bleu clair</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>

            <label class="mt-3">Couleur du vetement</label>
            <select name="sweet" id="test4" onchange="changeSweet()" class="form-control">
                <option value="#80C43B">Vert clair</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>
    <!--        <select id="test5" onchange="changeMouth()">
                <option value="start">----Selectionner une couleur de la bouche----</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>-->
            <label class="mt-3">Couleur de la barbe</label>
            <select id="test6" onchange="changeBeard()" class="form-control">
                <option value="#00004D">Bleu foncé</option>
                <option value="brown">Marron</option>
                <option value="green">Vert</option>
            </select>


        </div>
        <input type="submit" name="submit" value="Envoyer" class="btn btn-success mt-4" onclick="addAvatar()">
        <div id="error"></div>
    </div>
</div>
</main>

<?php include "../includes/footer.php"; ?>
<script src="../js/changeAccessories.js"></script>
<?php
include "../includes/scripts.php";
?>
</body>
</html>