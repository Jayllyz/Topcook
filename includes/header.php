<?php $active = " active"; ?>

<header id="header">
      <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="http://164.132.229.157/"><img src="http://164.132.229.157/images/topcook_logo.svg" width="50" height="50"></a>
          <button class="navbar-toggler" id="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link<?= $title == "Recettes"
                  ? $active
                  : " " ?> aria-current="page" href="http://164.132.229.157/toutes-nos-recettes">Recettes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?= $title == "Forum"
                  ? $active
                  : " " ?>" href="#">Forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link<?= $title == "TopCook - Concours"
                  ? $active
                  : " " ?>" aria-current="page" href="http://164.132.229.157/concours">Concours</a>
              </li>
              <?php if (!isset($_SESSION["id"])) { ?>
              <li class="nav-item">
                <a class="nav-link<?= $title == "Connexion"
                  ? $active
                  : " " ?>" aria-current="page" href="http://164.132.229.157/connexion">Connexion</a>
              </li>

              <li class="nav-item">
                <a class="nav-link<?= $title == "Inscription"
                  ? $active
                  : " " ?>" aria-current="page" href="http://164.132.229.157/inscription">Inscription</a>
              </li>
                <?php } else { ?>

                  <li class="nav-item">
                    <a class="nav-link<?= $title == "Mon profil"
                      ? $active
                      : " " ?>" aria-current="page" href="http://164.132.229.157/mon-profile">Mon profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link<?= $title == "TopCook - Mes recettes"
                      ? $active
                      : " " ?>" aria-current="page" href="http://164.132.229.157/mes-recettes">Mes recettes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="http://164.132.229.157/deconnexion.php">Deconnexion</a>
                  </li>
                  <?php } ?>

            </ul>
            <div id="moon">
              <button type="button" class="btn moon" onClick="darkMode()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
                  </svg>
              </button>
            </div>

            <div id="sun">
              <button type="button" class="btn sun" onClick="lightMode()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16" id="svg_sun">
                  <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                </svg>
              </button>
            </div>


          <?php if (isset($_SESSION["id"]) && $_SESSION["rights"] == 1) { ?>

            <a href="http://164.132.229.157/admin/admin.php" class="logo_admin">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="black" id="logo_admin">
                  <path d="M0 0 H24 V24 H0 V0 z" style="fill:none;"></path>
                  <path d="M17,11c0.34,0,0.67,0.04,1,0.09V6.27L10.5,3L3,6.27v4.91c0,4.54,3.2,8.79,7.5,9.82c0.55-0.13,1.08-0.32,1.6-0.55 C11.41,19.47,11,18.28,11,17C11,13.69,13.69,11,17,11z"></path>
                  <path d="M17,13c-2.21,0-4,1.79-4,4c0,2.21,1.79,4,4,4s4-1.79,4-4C21,14.79,19.21,13,17,13z M17,14.38c0.62,0,1.12,0.51,1.12,1.12 s-0.51,1.12-1.12,1.12s-1.12-0.51-1.12-1.12S16.38,14.38,17,14.38z M17,19.75c-0.93,0-1.74-0.46-2.24-1.17 c0.05-0.72,1.51-1.08,2.24-1.08s2.19,0.36,2.24,1.08C18.74,19.29,17.93,19.75,17,19.75z"></path>
                </svg>
            </a>
         
          <?php } ?>

          
        </div>
      </nav>
  <div class="container">
    <form class="d-flex searchbar pt-3 pb-5">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn" type="submit"><img src="http://164.132.229.157/images/search.svg" alt="search"></button>
    </form>
  </div>
  </header>
