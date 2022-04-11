<?php
session_start();
include "../includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Forum";
include "../includes/head.php";
?>
<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <div class="container col-md-6">
         <?php include "../includes/message.php"; ?>
        </div>
            <h1 class="pb-3 text-center"><strong>Forum</strong></h1>

            <?php if (isset($_SESSION["id"])) { ?>
              <div class="add-topic">
                  <a class="btn" href="add_topic.php">
                      Ajouter un topic
                  </a>
              </div>

      <?php } ?>

    </main>
    <?php include "../includes/footer.php"; ?>
</body>
</html>