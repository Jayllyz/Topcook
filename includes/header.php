<header id="header">
      <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand" href="http://164.132.229.157/index.php"><img src="../images/topcook_logo.svg" width="50" height="50"></a>
          <button class="navbar-toggler" id="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="http://164.132.229.157/recettes.php">Recettes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Forum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Concours</a>
              </li>
              <?php if (!isset($_SESSION["id"])) { ?>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="http://164.132.229.157/connexion.php">Connexion</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="http://164.132.229.157/inscription.php">Inscription</a>
              </li>
                <?php } else { ?>

                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="http://164.132.229.157/profile/profile.php">Mon profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="http://164.132.229.157/profile/mesRecettes.php">Mes recettes</a>
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

          </div>
        </div>
      </nav>
  <div class="container">
    <form class="d-flex searchbar pt-3 pb-5">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn" type="submit"><img src="../images/search.svg" alt="search"></button>
    </form>
  </div>
  </header>