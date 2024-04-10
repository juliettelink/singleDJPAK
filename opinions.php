<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/opinion.php";
require_once __DIR__ . "/lib/session.php";

$mainMenu["opinions.php"] = ["head_title" => "vos avis", "meta_description" => "espace pour donner son avis sur le garage", "exclude" => true];
require_once __DIR__ . "/templates/header.php";

$opinions = getOpinions($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nameClient = htmlspecialchars($_POST["nameClient"], ENT_QUOTES, 'UTF-8');
    $comment = htmlspecialchars($_POST["comment"], ENT_QUOTES, 'UTF-8');
    $date = $_POST["date"];
    $note = $_POST["note"];

    if (empty($nameClient) || empty($comment) || empty($date) || empty($note)) {
        // Au moins un champ obligatoire est vide
        $_SESSION['error_message'] = "Veuillez remplir tous les champs obligatoires.";
        } elseif (!strtotime($date)) {
            // La date n'est pas dans un format attendu
            $_SESSION['error_message'] = "La date n'est pas valide.";
        } else {
            
            $sql = "INSERT INTO opinions (nameClient, comment, date, note) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nameClient, $comment, $date, $note]);

            $_SESSION['success_message'] = "Votre avis a été bien pris en compte.";

            // Redirection vers la page d'avis après l'ajout
            header("Location: opinions.php");
            exit();
        }
}

// Affiche le  message de succès
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Supprime le message de succès 
}
?>
<div class="music">
    <div class="container">
        <h1>Vos Avis</h1>
        <div class="row">
            <div class="col-md-6 mx-auto ">
                <form action= "" method="post">
                    <div class="form-group">
                        <label for="nameClient">Votre nom</label>
                        <input class="form-control" type="text"  name="nameClient" id="nameClient" placeholder="votre nom" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Votre commentaire</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="votre commentaire"required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input class="form-control" type="date" name="date" id="date" required>
                    </div>
                    <div class= "form-group">
                        <ul class="rating">
                            <li class="lar la-star" data-value="1"></li>
                            <li class="lar la-star" data-value="2"></li>
                            <li class="lar la-star" data-value="3"></li>
                            <li class="lar la-star" data-value="4"></li>
                            <li class="lar la-star" data-value="5"></li>
                        </ul>
                        <input type="hidden" name="note" id="note" value="0">
                        <button class="btn btn-dark" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-4">
    <div class="col-md-4 d-flex align-items-center">
        <img src="assets/images/logo.png" alt="Votre Logo" class="mb-3 me-2 mb-md-0" width="30" height="24">
        <span class="mb-3 mb-md-0 text-body-secondary">2023 DJPAK, Inc</span>
    </div>
    <div class=" ">
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="logout.php" class="nav-link">Déconnexion</a>
        <?php else : ?>
            <a href="login.php" class="nav-link">Espace Pro</a>
        <?php endif; ?>
    </div>


    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex align-items-center">
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://open.spotify.com/intl-fr/artist/7L70NlXQPcsZrGWo2SCE9G"><img src="assets/images/spotify.png" alt="Spotify" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://on.soundcloud.com/S4mfY"><img src="assets/images/soundCloud.png" alt="Souncloud" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.youtube.com/results?search_query=djpak"><img src="assets/images/youtube.png" alt="YouTube" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.tiktok.com/@djpakafro?_t=8lPlQKN5Pay&_r=1"><img src="assets/images/tiktok.png" alt="TikTok" width="26"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.instagram.com/djpakafro/"><img src="assets/images/instagram.jpg" alt="Instagram" width="34"></a></li>
    </ul>
    </footer>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="assets/js/musicHome.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/opinionScript.js"></script>
<!-- <script src="/assets/js/private_politicy.js"></script> -->

</body>
</html>
