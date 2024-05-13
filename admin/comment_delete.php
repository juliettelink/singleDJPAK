<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/comment.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();
$comment = false;
$errors = [];
$messages = [];

if (isset($_GET['id'])) {
    $comment = getCommentById($pdo, $_GET['id']);
}
if ($comment) {
    if (deleteComment($pdo, $_GET["id"])) {
        $messages[] = "Le commentaire a bien été supprimé";
        header("Location: blogs.php");
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le commentaire n'existe pas";
}
    
    ?>
    <div class="row text-center my-5">
        <h1>Supression du commentaire</h1>
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