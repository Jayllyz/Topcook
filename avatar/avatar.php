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
        <div id="yeux">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="eyes" fill="#00004D" fill-rule="evenodd"
                      d="M201 80a8 8 0 1 1-16 0 8 8 0 0 1 16 0M135 80a8 8 0 1 1-16 0 8 8 0 0 1 16 0"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
    <!-- form envoie de l'image -->

    <form action="test.php" class="d-flex justify-content-center mt-4" method="post">
        <select name="avatar" id="test" onchange="changeCorps()">
            <option value="start">----Selectionner une couleur du corps----</option>
            <option value="brown">Marron</option>
            <option value="green">Vert</option>
        </select>
        <select name="avatar" id="test2" onchange="changeEyes()">
            <option value="start">----Selectionner une couleur des yeux----</option>
            <option value="brown">Marron</option>
            <option value="green">Vert</option>
        </select>

    </form>

    <!-- Télécharger l'image (pas encore fonctionnel) -->
    <a href="Test.svg" class="text-center mt-3" download="Test">Télécharger votre avatar !</a>

</div>
</main>

<?php include "../includes/footer.php"; ?>
<?php
include "../includes/scripts.php";
?>
</body>
</html>