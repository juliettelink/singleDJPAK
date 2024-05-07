<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/chanson.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();
$chanson = false;
$errors = [];
$messages = [];

if (isset($_GET['id'])) {
    $chanson = getChansonbyId($pdo, $_GET['id']);
}
if ($chanson) {
    if (deleteChanson($pdo, $_GET["id"])) {
        $messages[] = "La chanson a bien été supprimé";
        header("Location: albums.php");
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "La chanson n'existe pas";
}
    
    ?>
    <div class="row text-center my-5">
        <h1>Supression de la chanson</h1>
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
?>