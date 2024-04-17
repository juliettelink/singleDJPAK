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
<div class="fond">
    <div class="container  py-5">
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
   
 <?php
    require_once __DIR__ . "/templates/footer_fond.php";
