<?php
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";
$id = $_SESSION["id"];
if (isset($id)) { ?>
  <!DOCTYPE html>
  <html lang="fr">
  <?php
  $linkLogoOnglet = "../images/topcook_logo.svg";
  $linkCss = "../css/style.css";
  $title = "Mon profil";
  include "../includes/head.php";
  ?>

  <body onload="reloadAvatar()">
    <?php include "../includes/header.php"; ?>

    <main>
        <?php
        $req = $db->query(
            "SELECT pseudo, email,image, date_birth,rights, avatar, victory FROM USER WHERE id = " .
            $_SESSION["id"]
        );
        $req->execute([
            "id" => $id,
        ]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $select) { ?>
      <h2 class="text-center text-uppercase">Bienvenue sur votre profil <?= $select['pseudo'] ?> !</h2>


        <div class="container col-md-6">
          <?php include "../includes/message.php"; ?>
        </div>
        <div class="mt-3 mb-3 container">
          <div id="container_profil" class="card col-md-4 card_profil">
            <?php if (!empty($select["image"]) && $select["avatar"] === "0") { ?>
              <?php echo '<img src="../uploads/' .
                $select["image"] .
                '" class="card-img-top" id="img_profil" width="400" alt="...">'; ?>
            <?php } ?>
            <?php if ($select["avatar"] === "1") { ?>
              <div id="corps">
                <svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" fill="none" viewBox="0 0 320 320">
                  <path id="body" fill="#F5CDD3" fill-rule="evenodd" d="M290.963 248.235a80 80 0 0 0-44.227-31.543L204.999 205v-29.999c17.644-13.254 29.231-34.111 29.943-57.704A19.922 19.922 0 0 0 243 119c11.045 0 20-8.954 20-20s-8.955-20-20-20c-2.847 0-5.549.603-8 1.675V75c0-41.422-33.579-75-75-75h-.001C118.578 0 85 33.578 85 75v5.675A19.914 19.914 0 0 0 77 79c-11.046 0-20 8.954-20 20s8.954 20 20 20c2.869 0 5.591-.615 8.058-1.703.711 23.593 12.298 44.45 29.941 57.704V205l-41.736 11.692a80 80 0 0 0-44.227 31.543L0 290.24V320h320v-29.76l-29.037-42.005Z" clip-rule="evenodd" />
                  <path stroke="#00004D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M87.609 101.918c.255-.929.392-1.908.392-2.918 0-6.075-4.925-11-11-11-1.52 0-2.966.308-4.282.865M232.391 101.918A11.012 11.012 0 0 1 232 99c0-6.075 4.925-11 11-11 1.518 0 2.965.308 4.282.865" />
                </svg>

              </div>
            <?php echo "<div id='ajax'></div>";
            } ?>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Votre email: </strong><?= $select["email"] ?></li>
              <li class="list-group-item"><strong>Votre aniverssaire: </strong><?= $select["date_birth"] ?></li>
              <li class="list-group-item"><strong>Concours gagnés: </strong><?= $select["victory"] ?></li>
            </ul>
            <div class="card-body button_profil">
              <a href="https://topcook.site/profile/update/form_update.php?id=<?= $_SESSION["id"] ?>" class="btn card-link text-decoration-none" id="link-first">Modifier votre profil</a>
              <a href="https://topcook.site/avatar/avatar.php" class="btn mt-3 card-link text-decoration-none modify_avatar">Modifier votre avatar</a>
              <a class="btn mt-3 card-link text-decoration-none" id="avatarButton" onclick="activateAvatar()"><?= $select['avatar'] === '0' ? 'Activer' : 'Désactiver'; ?></a>
              <a href="https://topcook.site/profile/exportData.php" id="exportData" class="btn mt-3 card-link text-decoration-none">Exporter vos données</a>
            </div>
          </div>


        </div>
      <?php }
      ?>
    </main>

    <?php include "../includes/footer.php"; ?>
    <script src="../js/changeAccessories.js"></script>
    <script src="../js/avatar.js"></script>
    <?php include "../includes/scripts.php"; ?>
  </body>

  </html>
<?php } else {
  header("location: ../filigrane.php");
  exit();
} ?>
