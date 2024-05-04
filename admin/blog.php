<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/blog.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();

$errors = [];
$messages = [];
$blog = [
    'titre' => '',
    'date' => '',
    'sujet' => '',
];

if (isset($_GET['id'])) {
    // Requête pour récupérer les données du bog en cas de modification
    $blog = getBlogById($pdo, $_GET['id']);
    
    if ($blog === null) {
        $errors[] = "Le blog n'existe pas";
    }
    $pageTitle = "Formulaire de modification du blog";
} else {
    $pageTitle = "Formulaire ajout du blog";
}

if (isset($_POST['saveBlog'])) {
    // Validation pour s'assurer que les champs ne sont pas vides
    if (empty($_POST['titre'])) {
        $errors[] = "Le champ 'Titre du blog' ne peut pas être vide.";
    }

    if (empty($_POST['date'])) {
        $errors[] = "Le champ 'Date du blog' ne peut pas être vide.";
    }

    if (empty($_POST['sujet'])) {
        $errors[] = "Le champ 'Sujet' ne peut pas être vide.";
    }

    // Gestion de l'image
    $fileName = null;

    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _BLOG_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    unlink(dirname(__DIR__) . _BLOG_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                unlink(dirname(__DIR__) . _BLOG_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }


    // Construction du tableau $single
    $blog = [
        'titre' => $_POST['titre'],
        'date' => $_POST['date'],
        'sujet' => $_POST['sujet'],
        'image' => $fileName,
    ];

    // Si aucune erreur, procéder à la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveBlog($pdo, $_POST["titre"], $_POST['date'], $_POST["sujet"], $fileName, $id);

        if ($res) {
            $messages[] = "Le blog a bien été sauvegardé";
            if (!isset($_GET["id"])) {
                $blog = [
                    'titre' => '',
                    'date' => '',
                    'sujet' => ''
                ];
            }
        } else {
            $errors[] = "Le blog n'a pas été sauvegardé";
        }
    }
}

?>
<h1><?= $pageTitle; ?></h1>

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
<?php if ($blog !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Nom du blog</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= $blog['titre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= $blog['date']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="sujet" class="form-label">Sujet</label>
            <textarea class="form-control" id="sujet" name="sujet" required><?= $blog['sujet']; ?></textarea>
        </div>
        <?php if (isset($_GET['id']) && isset($blog['image'])) { ?>
            <p>
                <img src="../uploads/blog/<?= $blog['image'] ?>" alt="<?= $blog['titre'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $blog['image']; ?>">
            </p>
        <?php } ?>
        <p>
            <label for="file">Image </label>
            <input type="file" name="file" id="file">
        </p>
        
        <input type="submit" name="saveBlog" class="btn btn-primary" value="Enregistrer">
    </form>
<?php } ?>
<?php require_once __DIR__ . "/templates/footer.php"; ?>
