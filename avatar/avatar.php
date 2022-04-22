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
        <div id="barbe">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="beard" fill="#00004D" fill-rule="evenodd" d="m177.857 159.03-7.817 4.537a20 20 0 0 1-20.081 0l-7.817-4.537a10 10 0 0 1-4.421-11.944l1.343-3.846a4 4 0 0 1 3.776-2.683h34.319a4 4 0 0 1 3.776 2.683l1.343 3.846a10 10 0 0 1-4.421 11.944ZM228.221 109l-5.175 16.887a30.002 30.002 0 0 1-19.021 19.613l-9.622 3.273-3.848-7.587a20 20 0 0 0-17.837-10.953H147.281a20 20 0 0 0-17.837 10.953l-3.848 7.587-9.622-3.273a30.002 30.002 0 0 1-19.021-19.613L91.778 109A20.022 20.022 0 0 1 85 113.883v13.645a60.001 60.001 0 0 0 35.678 54.851l23.107 10.245a40 40 0 0 0 32.428 0l23.107-10.246c21.693-9.619 35.68-31.119 35.68-54.85v-13.645a20.026 20.026 0 0 1-6.779-4.883Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div id="vetement">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="sweet" fill="#80C43B" fill-rule="evenodd" d="m320 290.24-29.037-42.005a79.999 79.999 0 0 0-44.227-31.543l-2.211-.62-8.944-17.36a19.996 19.996 0 0 0-10.333-9.403L205 181.186v24.054l-.007.016-44.737 44.738c-.086 0-.17.006-.256.006l-45-45v-24.064l-20.248 8.124a19.998 19.998 0 0 0-10.333 9.402l-9.094 17.652-2.062.578a80.005 80.005 0 0 0-44.227 31.543L0 290.24V320h320v-29.76Z" clip-rule="evenodd"/>
                <path stroke="#00004D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M75.325 216.114 160 265.123l61.291-35.294"/>
                <path fill="#00004D" fill-rule="evenodd" d="M137 305.123a3 3 0 0 1-3-3v-51.972l6 3.396v48.576a3 3 0 0 1-3 3ZM183 284.123a3 3 0 0 1-3-3v-27.517l6-3.455v30.972a3 3 0 0 1-3 3Z" clip-rule="evenodd"/>
                <path stroke="#00004D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m107 197 8 8"/>
            </svg>

        </div>
        <div id="turban">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="hat" fill="#2384F5" fill-rule="evenodd" d="m160 74.347 53.153 30.937c13.527 7.873 20.992 22.342 20.992 37.993v2.001c15.463 0 28.855-12.536 28.855-28V88.672a61.175 61.175 0 0 0-23.754-48.394L208.937 16.84c-28.819-22.285-69.055-22.285-97.874 0L80.754 40.278A61.175 61.175 0 0 0 57 88.673v28.605c0 15.464 13.355 28 28.819 28v-2.001c0-15.651 7.501-30.12 21.028-37.993L160 74.347Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div id="bouche">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path id="mouth" stroke="#00004D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M172.56 133.5c-2.658 4.203-7.347 6.993-12.687 6.993-5.173 0-9.735-2.619-12.432-6.604"/>
            </svg>
        </div>
        <div id="cheveux">
            <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                <path fill="#00004D" fill-rule="evenodd" d="M240 84.249V80c0-15.346-4.329-29.678-11.82-41.855a80.38 80.38 0 0 0-28.085-27.361A79.595 79.595 0 0 0 160 0a79.592 79.592 0 0 0-40.095 10.784A80.38 80.38 0 0 0 91.82 38.145C84.329 50.322 80 64.654 80 80v4.249a19.924 19.924 0 0 1 10.828 5.323c9.214-9.248 16.634-20.282 21.682-32.549C126.638 64.662 142.812 69 160 69c17.188 0 33.362-4.338 47.49-11.977 5.047 12.267 12.469 23.301 21.682 32.549A19.924 19.924 0 0 1 240 84.249Z" clip-rule="evenodd"/>
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
<?php
include "../includes/scripts.php";
?>
</body>
</html>