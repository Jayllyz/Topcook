<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>TopCook</title>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <a class="navbar-brand" href="#"><img src="images/topcook_logo.svg" alt="Logo" width="50" height="50"></a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Recettes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Forums</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Concours</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Inscription</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <form class="d-flex searchbar pt-3 pb-5">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
  </header>
    <main>
      <h3 class="pb-4">Top recettes du mois</h3>
      <div class="container-fluid">
        <div class="best_recipe row m-auto">
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>

        </div>
        <div class="container pt-4">
          <div class="d-grid gap-2 col-3 mx-auto">
            <button class="btn btn-secondary" type="button">Voir plus...</button>
          </div>
        </div>

      </div>

      <h3 class="pt-5 pb-3">Dernières recettes publiées</h3>
      <div class="container-fluid">
        <div class="last_recipe row m-auto">
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
        </div>

        <div class="container pt-4">
          <div class="d-grid gap-2 col-3 mx-auto">
            <button class="btn btn-secondary" type="button">Voir plus...</button>
          </div>
        </div>
      </div>

      <h3 class="pt-5 pb-3">Derniers Topics publiées</h3>
      <div class="container">
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

      <div class="container competition">
        <h3 class="pt-5 pb-3">Concours en cours</h3>
        <a href=""><img src="..." class="img-fluid ps-5" alt="..."></a>
      </div>
    </main>

    <footer class="bg-light">Ceci est un footer</footer>
</body>
</html>
