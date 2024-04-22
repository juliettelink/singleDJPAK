<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";

require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/templates/header.php";


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newsletter_email"])) {
    // Récupérer l'adresse e-mail soumise
    $email = $_POST["newsletter_email"];

    // Vérifier le format de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Si l'adresse e-mail n'est pas valide, afficher un message d'erreur
        echo '<div class="alert alert-danger" role="alert">
                L\'adresse e-mail saisie n\'est pas valide.
            </div>';
    } else {
        // Vérifier si l'e-mail est déjà inscrit
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM newsletter_subscribers WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            // Si l'e-mail n'est pas déjà inscrit, l'ajouter à la base de données
            $stmt = $pdo->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
            $stmt->execute(["email" => $email]);

            // Définir la variable de session une fois que l'inscription est réussie
            $_SESSION['newsletter_subscribers'] = true;


            // Afficher un message de confirmation
            echo '<div class="alert alert-success" role="alert">
                        Vous avez été inscrit à la newsletter avec succès ! Vous allez étre rediriger vers la page musique.
                    </div>';
                // Rediriger l'utilisateur vers la page music après un délai de 2 secondes
                header("refresh:2;url=music.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Si l'e-mail est déjà inscrit, afficher un message d'erreur
            echo '<div class="alert alert-danger" role="alert">
                    L\'adresse e-mail est déjà inscrite à la newsletter.
                </div>';
        }
    }
}


?>
<div class="fond">
<div class="container py-5">
        <h1>Inscription à la newsletter</h1>
        <form method="post">
            <div class="form-group">
                <label for="newsletter_email">Adresse e-mail :</label>
                <input type="email" id="newsletter_email" name="newsletter_email" class="form-control mb-3" style="width: 50%;" required>
            </div>
            <button class="btn btn-dark" type="submit">S'inscrire</button>
        </form>
    </div>



<?php
    require_once __DIR__ . "/templates/footer_fond.php";
