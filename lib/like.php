
<?php

function getLikesCount(PDO $pdo, int $articleId): int {
    $query = "SELECT COUNT(*) AS likes_count FROM likes WHERE article_id = :articleId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['articleId' => $articleId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['likes_count'];
}

function incrementLike(PDO $pdo, $articleId) {
    // Obtenir la date et l'heure actuelles
    $currentDateTime = date('Y-m-d H:i:s');

    // Enregistrer le like dans la base de données avec la date actuelle
    $query = "INSERT INTO likes (article_id, created_at) VALUES (:articleId, :createdAt)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['articleId' => $articleId, 'createdAt' => $currentDateTime]);

    // Récupérer le nombre total de likes pour cet article
    $likesCount = getLikesCount($pdo, $articleId);
    
    return $likesCount;
}
?>
