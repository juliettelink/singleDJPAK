<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/album.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();

$errors = [];
$messages = [];
$album = [
    'titre' => '',
    'description' => '',
    'image' => ''
];


if (isset($_GET['id'])) {
    // Requête pour récupérer les données de l'album en cas de modification
    $album = getAlbumById($pdo, $_GET['id']);
    
    if ($album === null) {
        $errors[] = "L'album n'existe pas";
    }
    $pageTitle = "Formulaire de modification d'album";
} else {
    $pageTitle = "Formulaire d'ajout d'album";
}

if (isset($_POST['saveAlbum'])) {
    // Validation pour s'assurer que les champs ne sont pas vides
    if (empty($_POST['titre'])) {
        $errors[] = "Le champ 'Titre de l'album' ne peut pas être vide.";
    }

    if (empty($_POST['description'])) {
        $errors[] = "Le champ 'Description' ne peut pas être vide.";
    }

    // Gestion de l'image de l'album
    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;
            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__)._ALBUM_IMAGES_FOLDER_ . $fileName)) {
                if (!empty($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__)._ALBUM_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        // Si aucun fichier n'a été envoyé
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // Si on a coché la case de suppression d'image, on supprime l'image
                unlink(dirname(__DIR__)._ALBUM_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }


    // Construction du tableau $album
    $album = [
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'image' => $fileName
    ];

    // Si aucune erreur, procéder à la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveAlbum($pdo, $_POST["titre"], $_POST['description'], $fileName, $id);

        if ($res) {
            $messages[] = "L'album a bien été sauvegardé";
            if (!isset($_GET["id"])) {
                $album = [
                    'titre' => '',
                    'description' => ''
                ];
            }
        } else {
            $errors[] = "L'album n'a pas été sauvegardé";
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
<?php if ($album !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'album</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= $album['titre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= $album['description']; ?></textarea>
        </div>
        <?php if (isset($_GET['id']) && isset($album['image'])) { ?>
            <p>
                <img src="../assets/albums/pochettes/<?= $album['image'] ?>" alt="<?= $album['titre'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $album['image']; ?>">
            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>
        <input type="submit" name="saveAlbum" class="btn btn-primary" value="Enregistrer">
    </form>
<?php } ?>
<?php require_once __DIR__ . "/templates/footer.php"; ?>