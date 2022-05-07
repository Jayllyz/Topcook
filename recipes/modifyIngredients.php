<?php
session_start();

$name = htmlspecialchars($_GET['name']);
$id = htmlspecialchars($_GET['id']);
$nbIngredients = htmlspecialchars($_GET['nbIngredients']);
include "../includes/db.php";

?>
<!doctype html>
<html lang="fr">
<?php
$linkLogoOnglet = "../images/topcook_logo.svg";
$linkCss = "../css/style.css";
$title = "Topcook - Modifier les ingrédients";
include "../includes/head.php";
?>
<body>

<?php include "../includes/header.php"; ?>
<main>
<h1>Modifier les ingrédients</h1>
<div class="d-flex justify-content-center flex-wrap">
    <div class="p-4">
        <form action="scriptModifyIngredients.php?id_recipe=<?= $id ?>" method="post">
<?php
$selectIngredients = $db->query("SELECT name, quantity, unit FROM INGREDIENT WHERE id_recipe = ".$id);
$ingredients = $selectIngredients->fetchAll(PDO::FETCH_ASSOC);
foreach ($ingredients as $ingredient) {
?>

        <input type="text" name="ingredients[]" class="form-control steps-input ingredient" placeholder="Ingredients 1" value="<?= $ingredient['name'] ?>" required>
        <input type="number" name="quantity[]" class="form-control steps-input quantity" placeholder="Quantitée" value="<?= $ingredient['quantity'] ?>" required>
        <select name="unit[]" class="form-control steps-input unit">
            <option value="g">g</option>
            <option value="cl">cl</option>
            <option value="vide">Vide</option>
        </select>

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
