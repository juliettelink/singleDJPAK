<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";


require_once __DIR__ . "/../lib/pdo.php";

require_once __DIR__ . "/../lib/single.php";
require_once __DIR__ . "/templates/header.php";



$single = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $single =  getSinglesById($pdo, (int)$_GET["id"]);
}
if ($single) {
    if (deleteSingles($pdo, $_GET["id"])) {
        $messages[] = "Le single a bien été supprimé";
        header("Location: singles.php");
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le single n'existe pas";
}

?>
<div class="row text-center my-5">
    <h1>Supression du single</h1>
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
</div>

<?php
require_once __DIR__ ."/templates/footer.php";