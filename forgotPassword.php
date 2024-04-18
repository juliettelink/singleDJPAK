<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/user.php";
require_once __DIR__ . "/templates/header.php";

$errors = [];


if (isset($_POST['email'])) {
    $password = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $subject = 'Mot de passe oublié';
    $message = "Bonjour, voici votre nouveau mot de passe : $password";
    $headers = 'Content-Type: text/plain; charset="UTF-8"';

    if (mail($_POST['email'], $subject, $message, $headers)) {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashedPassword, $_POST['email']]);
        echo "E-mail envoyé";
    } else {
        echo "Une erreur est survenue";
    }
}
?>

<div class="container">
    <h1>Mot de passe oublié</h1>
    <form method="POST">
        <div class="m-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <input type="submit" value="Réinitialiser le mot de passe" name="resetPassword" class="btn btn-dark">
    </form>
</div>

<?php
require_once __DIR__ . "/templates/footer.php";
?>
