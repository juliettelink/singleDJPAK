<?php 

require_once __DIR__."/../config.php";
require_once __DIR__ . "/../lib/session.php";

require_once __DIR__."/../lib/pdo.php";
require_once __DIR__."/../lib/user.php";

require_once __DIR__. "/templates/header.php";

adminOnly();

$csrfToken = $_SESSION['csrf_token'];

$errors = [];
$messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verification CSRF
    
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = 'Erreur CSRF : tentative de requête non autorisée.';
    
    } else {
        $mail_id = filter_var($_POST['mail_id'], FILTER_VALIDATE_EMAIL);
        $name = htmlspecialchars($_POST['name']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $password = $_POST['password'];

        // Vérifie si tous les champs du formulaire sont remplis
        if (empty($_POST['mail_id']) || empty($_POST['name']) || empty($_POST['firstname']) || empty($_POST['password'])) {
            $errors[] = 'Tous les champs du formulaire doivent être remplis.';
        } else {
            // Vérifie si l'adresse e-mail est déjà utilisée 
            if (emailAlreadyExists($pdo, $_POST['mail_id'])) {
                $errors[] = 'L\'adresse e-mail est déjà utilisée par un autre utilisateur.';
            }
            //complexité du mot de passe
            if (!isStrongPassword($_POST['password'])) {
                $errors[] = 'Le mot de passe doit contenir au moins une minuscule, une majuscule, un caractère spécial et
                            avoir une longueur minimale de 8 caractères.';
            }

            // ajout de l'employé
            if (empty($errors)) {
                $roleName = 'employe'; 
                $roleId = getRoleIdByName($pdo, $roleName);
                $res = addUser($pdo, $mail_id, $name, $firstname, $password, $roleId);
                if ($res) {
                    $messages[] = 'Inscription réussie';
                } else {
                    $errors[] = 'Une erreur s\'est produite lors de votre inscription.';
                    echo "Erreur lors de l'ajout de l'utilisateur : " . print_r($pdo->errorInfo(), true);
                }
            }
        }
    }
}
?>

<h1 class="py-3">Inscription employé</h1>

<?php foreach ($messages as $message){ ?>
    <div class="alert alert-success" role="alert">
<?= $message; ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error){ ?>
    <div class="alert alert-danger" role="alert">
<?= $error; ?>
    </div>
<?php } ?>


<form method="POST">
    <!-- Champ caché pour stocker le jeton CSRF -->
    <div class="mb-3">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
    </div>
    
    <div class="mb-3">
        <label for="mail_id" class="form-label">Email</label>
        <input type="email" class="form-control" id="mail_id" name="mail_id" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <span id="eye-icon" class="eye-icon" onclick="passwordVisibility()">👁️</span>
    </div>

    <input type="submit" name="addUser" class="btn btn-primary" value="Enregistrer" required>
</form>
<br>

<h2>Listes des employés</h2>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Email</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Action</th>
    </thead>
    <tbody>
        <?php 
        $users = getUsers($pdo);
        foreach($users as $user) {
            //excepter le compte de admin.
            if ($user["mail_id"] == "pacomebellony@gmail.com") {
                continue; 
            }
            ?>
        <tr>
            <th scope="row"><?= $user["mail_id"] ?></th>
            <td><?= $user["name"] ?></td>
            <td><?= $user["firstname"] ?></td>
            <td>
                <a href="user_delete.php?id=<?=urlencode($user['mail_id'])?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer de l\'employé')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>

<?php

require_once __DIR__ ."/templates/footer.php";