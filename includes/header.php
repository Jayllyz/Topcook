<?php $active = " active"; ?>
<header id="header" class="pb-3">
  <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="https://topcook.site/"><img src="https://topcook.site/images/topcook_logo.svg" width="50" height="50"></a>
      <button class="navbar-toggler" id="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link<?= $title == "Recettes"
                                ? $active
                                : " " ?> aria-current=" page" href="https://topcook.site/toutes-nos-recettes">Recettes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= $title == "Forum"
                                ? $active
                                : " " ?>" aria-current="page" href="https://topcook.site/forum">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= $title == "TopCook - Concours"
                                ? $active
                                : " " ?>" aria-current="page" href="https://topcook.site/concours">Concours</a>
          </li>
          <?php if (!isset($_SESSION["id"])) { ?>
            <li class="nav-item">
              <a class="nav-link<?= $title == "Connexion"
                                  ? $active
                                  : " " ?>" aria-current="page" href="https://topcook.site/connexion">Connexion</a>
            </li>

            <li class="nav-item">
              <a class="nav-link<?= $title == "Inscription"
                                  ? $active
                                  : " " ?>" aria-current="page" href="https://topcook.site/inscription">Inscription</a>
            </li>
          <?php } else { ?>

            <li class="nav-item">
              <a class="nav-link<?= $title == "Mon profil"
                                  ? $active
                                  : " " ?>" aria-current="page" href="https://topcook.site/mon-profile">Mon profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?= $title == "TopCook - Mes recettes"
                                  ? $active
                                  : " " ?>" aria-current="page" href="https://topcook.site/mes-recettes">Mes recettes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?= $title == "TopCook - Mes favoris"
                                  ? $active
                                  : " " ?>" aria-current="page" href="https://topcook.site/recettes-favorites">Mes favoris</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="https://topcook.site/deconnexion.php">Deconnexion</a>
            </li>
          <?php } ?>

        </ul>

        <div id="moon" class="me-2">
          <img src="https://topcook.site/images/darkmode.svg" id="darkmode" alt="darkmode-logo" width="24" height="24">
        </div>


        <?php if (isset($_SESSION["id"]) && $_SESSION["rights"] == 1) { ?>

          <a href="https://topcook.site/admin/admin.php" class="logo_admin">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="black" id="logo_admin">
              <path d="M0 0 H24 V24 H0 V0 z" style="fill:none;"></path>
              <path d="M17,11c0.34,0,0.67,0.04,1,0.09V6.27L10.5,3L3,6.27v4.91c0,4.54,3.2,8.79,7.5,9.82c0.55-0.13,1.08-0.32,1.6-0.55 C11.41,19.47,11,18.28,11,17C11,13.69,13.69,11,17,11z"></path>
              <path d="M17,13c-2.21,0-4,1.79-4,4c0,2.21,1.79,4,4,4s4-1.79,4-4C21,14.79,19.21,13,17,13z M17,14.38c0.62,0,1.12,0.51,1.12,1.12 s-0.51,1.12-1.12,1.12s-1.12-0.51-1.12-1.12S16.38,14.38,17,14.38z M17,19.75c-0.93,0-1.74-0.46-2.24-1.17 c0.05-0.72,1.51-1.08,2.24-1.08s2.19,0.36,2.24,1.08C18.74,19.29,17.93,19.75,17,19.75z"></path>
            </svg>
          </a>

        <?php } ?>


      </div>

  </nav>


  <div class="container" id="container-search">
    <form class="d-flex searchbar pt-3 mb-2">
      <input class="form-control me-2" type="search" id="searchbar" placeholder="Saisir une recette, un topic <?= $_SESSION['rights'] == 1 ? 'ou un utilisateur' : '' ?> à rechercher" aria-label="Search">
    </form>
  </div>
</header>