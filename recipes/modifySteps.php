<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
$name = htmlspecialchars($_GET['name']);
$id = htmlspecialchars($_GET['id']);
$nbSteps = htmlspecialchars($_GET['nbSteps']);
include "../includes/db.php";

?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Topcook - Modifier les étapes";
include "../includes/head.php";
?>

<body>

    <?php include "../includes/header.php"; ?>
    <main>
        <h1>Modifier les étapes</h1>
        <div class="d-flex justify-content-center flex-wrap">
            <div class="p-4">
                <?php
                $selectSteps = $db->query("SELECT id, details FROM STEPS WHERE id_recipe = " . $id);
                $steps = $selectSteps->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form action="scriptModifySteps.php?id_recipe=<?= $id ?>&id_steps=<?= $steps[0]['id'] ?>" method="post">
                    <?php
                    foreach ($steps as $step) {
                    ?>
                        <input type="text" name="steps[]" class="form-control steps-input ingredient" placeholder="Etape 1" value="<?= $step['details'] ?>" required>

            </div>
        <?php } ?>
        <button type="submit" name="submit" class="btn mt-3" data-bs-dismiss="modal">Valider</button>
        </form>
        </div>


    </main>
    <?php include "../includes/footer.php"; ?>

    <?php include "../includes/scripts.php"; ?>
</body>

</html>