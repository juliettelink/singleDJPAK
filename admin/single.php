<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/single.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();

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

    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _SINGLES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    unlink(dirname(__DIR__) . _SINGLES_IMAGES_FOLDER_ . $_POST['image']);
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
                unlink(dirname(__DIR__) . _SINGLES_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }

// Gestion du fichier audio
$audioName = null;

if (isset($_FILES["audio"]["tmp_name"]) && $_FILES["audio"]["tmp_name"] != '') {
    // Check if the uploaded file is an MP3 audio file
    $audioFileType = strtolower(pathinfo($_FILES["audio"]["name"], PATHINFO_EXTENSION));
    if ($audioFileType != "mp3") {
        $errors[] = 'Le fichier audio doit être au format MP3.';
    } else {
        // Proceed with saving the MP3 audio file
        $audioName = slugify(basename($_FILES["audio"]["name"]));
        $audioName = uniqid() . '-' . $audioName;

        if (move_uploaded_file($_FILES["audio"]["tmp_name"], dirname(__DIR__) . _SINGLES_AUDIOS_FOLDER_ . $audioName)) {
            if (isset($_POST['audio'])) {
                unlink(dirname(__DIR__) . _SINGLES_AUDIOS_FOLDER_ . $_POST['audio']);
            }
        } else {
            $errors[] = 'Le fichier audio n\'a pas été téléchargé';
        }
    }
} else {
    if (isset($_GET['id'])) {
        if (isset($_POST['delete_audio'])) {
            unlink(dirname(__DIR__) . _SINGLES_AUDIOS_FOLDER_ . $_POST['audio']);
        } else {
            $audioName = $_POST['audio'];
        }
    }
}

    // Construction du tableau $single
    $single = [
        'title' => $_POST['title'],
        'duration' => $_POST['duration'],
        'description' => $_POST['description'],
        'image' => $fileName,
        'audio' => $audioName
    ];

    // Si aucune erreur, procéder à la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }

        $res = saveSingles($pdo, $_POST["title"], $_POST['duration'], $_POST["description"], $fileName, $audioName, $id);

        if ($res) {
            $messages[] = "Le single a bien été sauvegardé";
            if (!isset($_GET["id"])) {
                $single = [
                    'title' => '',
                    'duration' => '',
                    'description' => ''
                ];
            }
        } else {
            $errors[] = "Le single n'a pas été sauvegardé";
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
    <form method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Nom de la musique</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $single['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durée</label>
            <input type="text" class="form-control" id="duration" name="duration" value="<?= $single['duration']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= $single['description']; ?></textarea>
        </div>
        <?php if (isset($_GET['id']) && isset($single['image'])) { ?>
            <p>
                <img src="../uploads/singles/<?= $single['image'] ?>" alt="<?= $single['title'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $single['image']; ?>">
            </p>
        <?php } ?>
        <p>
            <label for="file">Image (1500x841)</label>
            <input type="file" name="file" id="file">
        </p>
        <?php if (isset($_GET['id']) && isset($single['audio'])) { ?>
            <p>
                <audio controls>
                    <source src="../assets/music/<?= $single['audio'] ?>" type="audio/mpeg">
                    Votre navigateur ne supporte pas l'audio HTML5.
                </audio>
                <label for="delete_audio">Supprimer le fichier audio</label>
                <input type="checkbox" name="delete_audio" id="delete_audio">
                <input type="hidden" name="audio" value="<?= $single['audio']; ?>">
            </p>
        <?php } ?>
        <p>
            <label for="audio">Audio</label>
            <input type="file" name="audio" id="audio">
        </p>
        <input type="submit" name="saveSingle" class="btn btn-primary" value="Enregistrer">
    </form>
<?php } ?>
<?php require_once __DIR__ . "/templates/footer.php"; ?>
