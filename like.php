<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/like.php";

// Vérifier si l'identifiant de l'article a été reçu
if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];
    
    // Obtenir la date et l'heure actuelles
    $currentDateTime = date('Y-m-d H:i:s');

    // Enregistrer le like dans la base de données avec la date actuelle
    $query = "INSERT INTO likes (article_id, created_at) VALUES (:articleId, :createdAt)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['articleId' => $articleId, 'createdAt' => $currentDateTime]);

    // Récupérer le nombre total de likes pour cet article
    $likesCount = getLikesCount($pdo, $articleId);
    echo $likesCount; // Envoyer le nombre de likes en réponse à la requête AJAX
} else {
    http_response_code(400); // Bad request
    echo "Identifiant de l'article manquant dans la requête.";
}
?>