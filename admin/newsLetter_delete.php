<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";


require_once __DIR__ . "/../lib/pdo.php";

require_once __DIR__ . "/../lib/newsLetter.php";
require_once __DIR__ . "/templates/header.php";



$newsLetters = false;
$errors = [];
$messages = [];

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
    if (deleteNewsLetters($pdo, $id)) {
        $messages[] = "L'avis a bien été supprimé";
        header("Location: newsLetter.php");
        exit();
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Aucun ID d'email spécifié";
}

?>
<div class="row text-center my-5">
    <h1>Supression de l'email du client</h1>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
    <?php if (!$messages) { ?>
        <form method="post">
            <input type="submit" name="confirmDelete" class="btn btn-danger" value="Confirmer la suppression">
        </form>
    <?php } ?>
</div>

<?php
require_once __DIR__ ."/templates/footer.php";