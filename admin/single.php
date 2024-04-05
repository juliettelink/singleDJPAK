<?php

require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/single.php";
require_once __DIR__ . "/templates/header.php";

$errors = [];
$messages = [];
$single = [
    'title' => '',
    'duration' => '',
    'description' => '',
];

if (isset($_GET['id'])) {
    // Requête pour récupérer les données du single en cas de modification
    $single = getSinglesById($pdo, $_GET['id']);
    
    if ($single === null) {
        $errors[] = "Le single n'existe pas";
    }
    $pageTitle = "Formulaire de modification du single";
} else {
    $pageTitle = "Formulaire ajout du single";
}

if (isset($_POST['saveSingle'])) {
    // Validation pour s'assurer que les champs ne sont pas vides
    if (empty($_POST['title'])) {
        $errors[] = "Le champ 'Nom du single' ne peut pas être vide.";
    }

    if (empty($_POST['duration'])) {
        $errors[] = "Le champ 'Durée du single' ne peut pas être vide.";
    }

    if (empty($_POST['description'])) {
        $errors[] = "Le champ 'Description' ne peut pas être vide.";
    }

    // Gestion de l'image
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
                if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__)._SINGLES_IMAGES_FOLDER_ . $fileName)) {
                    if (isset($_POST['image'])) {
                        // On supprime l'ancienne image si on a posté une nouvelle
                        unlink(dirname(__DIR__)._SINGLES_IMAGES_FOLDER_ . $_POST['image']);
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
                    unlink(dirname(__DIR__)._SINGLES_IMAGES_FOLDER_ . $_POST['image']);
                } else {
                    $fileName = $_POST['image'];
                }
            }
        }

    // if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
    //     $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
    //     $imageType = exif_imagetype($_FILES["file"]["tmp_name"]);

    //     if (!in_array($imageType, $allowedTypes)) {
    //         $errors[] = 'Le fichier doit être une image valide (JPEG, PNG, GIF)';
    //     }

    //     $maxFileSize = 5 * 1024 * 1024; // 5 Mo
    //     if ($_FILES["file"]["size"] > $maxFileSize) {
    //         $errors[] = 'Le fichier est trop volumineux. La taille maximale autorisée est de 5 Mo.';
    //     }

    //     if (empty($errors)) {
    //         $fileName = uniqid() . '-' . slugify(basename($_FILES["file"]["name"]));
    //         $filePath = dirname(__DIR__) . _SINGLES_IMAGES_FOLDER_ . $fileName;

    //         if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
    //             if (isset($_POST['image']) && $_POST['image'] !== 'img_default.jpg') {
    //                 unlink(dirname(__DIR__) . _SINGLES_IMAGES_FOLDER_ . $_POST['image']);
    //             }
    //         } else {
    //             $errors[] = 'Le fichier n\'a pas été uploadé';
    //         }
    //     }
    // } else {
    //     // Si aucune nouvelle image n'a été téléversée
    //     if (isset($_GET['id'])) {
    //         // Si vous modifiez un enregistrement existant, utilisez l'ancien nom de fichier
    //         $fileName = $single['image'];
    //     } else {
    //         // Si vous ajoutez un nouvel enregistrement et qu'aucune image n'est téléversée, utilisez une valeur par défaut
    //         $fileName = 'img_default.jpg';
    //     }
    // }

    $single = [
        'title' => $_POST['title'],
        'duration' => $_POST['duration'],
        'description' => $_POST['description'],
        'image' => $fileName
    ];

        // Si il n'y a pas d'erreur on peut faire la sauvegarde
        if (!$errors) {
            if (isset($_GET["id"])) {
                // Avec (int) on s'assure que la valeur stockée sera de type int
                $id = (int)$_GET["id"];
            } else {
                $id = null;
            }
            // On passe toutes les données à la fonction saveArticle
            $res = saveSingles($pdo, $_POST["title"], $_POST['duration'], $_POST["description"], $fileName, $id);
    
            if ($res) {
                $messages[] = "L'article a bien été sauvegardé";
                //On vide le tableau article pour avoir les champs de formulaire vides
                if (!isset($_GET["id"])) {
                    $single = [
                        'title' => '',
                        'duration' => '',
                        'description' => ''
                    ];
                }
            } else {
                $errors[] = "L'article n'a pas été sauvegardé";
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
<?php if ($single !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Nom du single</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $single['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durée du single</label>
            <input type="time" class="form-control" id="duration" name="duration" value="<?= $single['duration']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= $single['description']; ?></textarea>
        </div>
        <?php if (isset($_GET['id']) && isset($single['image'])) { ?>
            <p>
                <img src="<?= _SINGLES_IMAGES_FOLDER_ . $single['image'] ?>" alt="<?= $single['title'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $single['image']; ?>">
            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>
        <input type="submit" name="saveSingle" class="btn btn-primary" value="Enregistrer">
    </form>
<?php } ?>
<?php require_once __DIR__ . "/templates/footer.php"; ?>
