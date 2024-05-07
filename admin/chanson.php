
<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/album.php";
require_once __DIR__ . "/../lib/chanson.php";
require_once __DIR__ . "/templates/header.php";

adminOnly();

$albums = getAllAlbums($pdo);
$errors = [];
$messages = [];

if (isset($_POST['saveChansons'])) {
    $albumId = $_POST['album'];
    $nbChansons = $_POST['nbChansons'];

    // Parcourir chaque chanson et la traiter individuellement
    for ($i = 0; $i < $nbChansons; $i++) {
        // Vérifier si tous les champs sont remplis
        $titre = $_POST['titres'][$i];
        $audioTmpName = $_FILES['audios']['tmp_name'][$i];
        $imageTmpName = isset($_FILES['images']['tmp_name'][$i]) ? $_FILES['images']['tmp_name'][$i] : '';

        if (empty($titre) || empty($audioTmpName)) {
            $errors[] = "Le titre et le fichier audio sont obligatoires pour chaque chanson.";
            continue; // Passer à la chanson suivante si des champs sont manquants
        }

        // Enregistrer les fichiers audio dans le dossier approprié
        $audioFileName = basename($_FILES['audios']['name'][$i]);
        $targetPathAudio = dirname(__DIR__) . _ALBUM_SONS_FOLDER_ . $audioFileName;

        // Vérifier si le dossier de destination existe et est accessible en écriture
        if (!file_exists(dirname(__DIR__) . _ALBUM_SONS_FOLDER_) || !is_writable(dirname(__DIR__) . _ALBUM_SONS_FOLDER_)) {
            $errors[] = "Le dossier de destination pour les fichiers audio n'existe pas ou n'est pas accessible en écriture.";
            continue; // Passer à la chanson suivante en cas d'échec
        }

        // Déplacer le fichier audio vers le dossier de destination
        if (!move_uploaded_file($audioTmpName, $targetPathAudio)) {
            $errors[] = "Erreur lors de l'enregistrement du fichier audio.";
            continue; // Passer à la chanson suivante en cas d'échec
        }

        // Enregistrer l'image uniquement si elle est fournie
        if (!empty($imageTmpName)) {
            $imageFileName = basename($_FILES['images']['name'][$i]);
            $targetPathImage = dirname(__DIR__) . _ALBUM_IMAGES_FOLDER_ . $imageFileName;

            // Vérifier si le dossier de destination existe et est accessible en écriture
            if (!file_exists(dirname(__DIR__) . _ALBUM_IMAGES_FOLDER_) || !is_writable(dirname(__DIR__) . _ALBUM_IMAGES_FOLDER_)) {
                $errors[] = "Le dossier de destination pour les images n'existe pas ou n'est pas accessible en écriture.";
                continue; // Passer à la chanson suivante en cas d'échec
            }

            // Déplacer le fichier image vers le dossier de destination
            if (!move_uploaded_file($imageTmpName, $targetPathImage)) {
                $errors[] = "Erreur lors de l'enregistrement du fichier image.";
                continue; // Passer à la chanson suivante en cas d'échec
            }
        }

        // Insérer la chanson dans la base de données
        $query = "INSERT INTO chanson (album_id, titre, audio, image) VALUES (:album_id, :titre, :audio, :image)";
        $params = [
            'album_id' => $albumId,
            'titre' => $titre,
            'audio' => $audioFileName,
            'image' => $imageFileName ?? null
        ];

        $statement = $pdo->prepare($query);
        $success = $statement->execute($params);

        // Traiter les résultats
        if ($success) {
            $messages[] = "La chanson \"$titre\" a été ajoutée avec succès à l'album.";
        } else {
            $errors[] = "Erreur lors de l'ajout de la chanson \"$titre\" à l'album.";
        }
    }
}

?>

<?php if (!empty($errors)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error) { ?>
            <p><?= $error ?></p>
        <?php } ?>
    </div>
<?php } ?>

<?php if (!empty($messages)) { ?>
    <div class="alert alert-success" role="alert">
        <?php foreach ($messages as $message) { ?>
            <p><?= $message ?></p>
        <?php } ?>
    </div>
<?php } ?>

<h1> Ajout de sons à l'album</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="album" class="form-label">Album</label>
        <select name="album" id="album" class="form-select" required>
            <option value="">Sélectionnez un album</option>
            <?php foreach ($albums as $album) { ?>
                <option value="<?= $album['album_id']; ?>"><?= $album['titre']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="nbChansons" class="form-label">Nombre de chansons à ajouter</label>
        <input type="number" name="nbChansons" id="nbChansons" class="form-control" required>
    </div>
    <div id="chansonsFields"></div>
    <input type="submit" name="saveChansons" class="btn btn-primary" value="Ajouter les chansons">
</form>


<script>
    document.getElementById('nbChansons').addEventListener('input', function() {
        var nbChansons = parseInt(this.value);
        var chansonsFields = document.getElementById('chansonsFields');
        chansonsFields.innerHTML = ''; // Efface les champs précédemment générés
        
        for (var i = 0; i < nbChansons; i++) {
            var chansonFieldset = document.createElement('fieldset');
            chansonFieldset.innerHTML = `
                <legend>Chanson ${i+1}</legend>
                <div class="mb-3">
                    <label for="titre${i}" class="form-label">Titre de la chanson</label>
                    <input type="text" name="titres[]" id="titre${i}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="audio${i}" class="form-label">Fichier audio</label>
                    <input type="file" name="audios[]" id="audio${i}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="image${i}" class="form-label">Image de la chanson</label>
                    <input type="file" name="images[]" id="image${i}" class="form-control" required>
                </div>
            `;
            chansonsFields.appendChild(chansonFieldset);
        }
    });
</script>

<?php require_once __DIR__ . "/templates/footer.php"; ?>