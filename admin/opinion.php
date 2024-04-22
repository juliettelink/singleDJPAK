<?php

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
require_once __DIR__ . "/../lib/opinion.php";
require_once __DIR__ . "/templates/header.php";

employeAndAdmin();


$errors = [];
$messages = [];
$opinion = [
    'nameClient' => '',
    'comment' => '',
    'note' => '',
    'date' => '',
];


if (isset($_GET['id'])) {
    //requête pour récupérer les données de l'article en cas de modification
    $opinions = getOpinions($pdo);
    $opinion = findOpinionById($pdo, $_GET['id']);
    if ($opinion === null) {
        $errors[] = "L'avis n\'existe pas";
    }
    $pageTitle = "Formulaire de modification de l'avis";
} else {
    $pageTitle = "Formulaire ajout de la l'avis";
}

// var_dump($opinion);
// var_dump($_GET);

if (isset($_POST['saveOpinion'])) {

    // Validation pour s'assurer que le champ 'nameClient' n'est pas vide
    if (empty($_POST['nameClient'])) {
        $errors[] = "Le champ 'nom du client' ne peut pas être vide.";
    }

    // Validation pour s'assurer que le champ 'comment' n'est pas vide
    if (empty($_POST['comment'])) {
        $errors[] = "Le champ 'Commentaire' ne peut pas être vide.";
    }
    // Validation pour s'assurer que le champ 'note' n'est pas vide
    if (empty($_POST['note'])) {
        $errors[] = "Le champ 'note' ne peut pas être vide.";
    }

    // Validation pour s'assurer que le champ 'date' n'est pas vide
    if (empty($_POST['date'])) {
        $errors[] = "Le champ 'date' ne peut pas être vide.";
    }
    $opinion = [
        'nameClient' => $_POST['nameClient'],
        'comment' => $_POST['comment'],
        'note' => $_POST['note'],
        'date' => $_POST['date']
    ];
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // On passe toutes les données à la fonction 
        $res = saveOpinion($pdo, $_POST["nameClient"], $_POST["comment"], $_POST["note"], $_POST["date"], $id);

        if ($res) {
            $messages[] = "L'avis a bien été sauvegardé";
            //On vide le tableau pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $opinion = [
                    'nameClient' => '',
                    'comment' => '',
                    'note' => '',
                    'date' => ''
                ];
            }
        } else {
            $errors[] = "L'avis n'a pas été sauvegardé";
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
<?php if ($opinion !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nameClient" class="form-label">Nom du client</label>
            <input type="text" class="form-control" id="nameClient" name="nameClient" value="<?= $opinion['nameClient']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea class="form-control" id="comment" name="comment" required><?= $opinion['comment']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <input type="number" class="form-control" id="note" name="note" value="<?= $opinion['note']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= $opinion['date']; ?>" required>
        </div>

        <input type="submit" name="saveOpinion" class="btn btn-primary" value="Enregistrer">

    </form>

<?php } ?>



<?php require_once __DIR__ . "/templates/footer.php"; ?>




