<?php


function getCommentsByArticleId($pdo, $article_id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM comment_blog WHERE article_id=:id");
    $query->bindValue(":id", $article_id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function saveComment(PDO $pdo, string $name, string $comment, int $articleId) {
    try {
        // Préparer la requête d'insertion
        $query = "INSERT INTO comment_blog (name, comment, article_id) VALUES (:name, :comment, :articleId)";
        $stmt = $pdo->prepare($query);
        
        // Exécuter la requête en liant les valeurs des paramètres
        $stmt->execute([
            'name' => $name,
            'comment' => $comment,
            'articleId' => $articleId
        ]);
        echo '<div class="alert alert-success" role="alert">Merci pour votre commentaire !</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'enregistrement du commentaire : ' . $e->getMessage() . '</div>';
    }
}