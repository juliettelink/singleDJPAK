<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";


require_once __DIR__ . "/../lib/pdo.php";

require_once __DIR__ . "/../lib/blog.php";
require_once __DIR__ . "/templates/header.php";


adminOnly();

$blog = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $blog =  getBlogById($pdo, (int)$_GET["id"]);
}
if ($blog) {
    if (deleteBlog($pdo, $_GET["id"])) {
        $messages[] = "Le blog a bien été supprimé";
        header("Location: blogs.php");
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le blog n'existe pas";
}

?>
<div class="row text-center my-5">
    <h1>Supression du blog</h1>
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