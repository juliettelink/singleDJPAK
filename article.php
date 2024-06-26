<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/blog.php";
require_once __DIR__ . "/lib/like.php";
require_once __DIR__ . "/lib/comment.php";

require_once __DIR__ . "/templates/header.php";

// Vérifier si un identifiant d'article a été passé dans l'URL
if (!isset($_GET['id'])) {
    // Rediriger l'utilisateur s'il n'y a pas d'identifiant d'article
    header("Location: blog.php");
    exit();
}

// Récupérer l'identifiant de l'article depuis l'URL
$article_id = $_GET['id'];

// Obtenir les détails de l'article
$article = getBlogById($pdo, $article_id);

// Vérifier si l'article existe
if (!$article) {
    // Rediriger l'utilisateur si l'article n'existe pas
    header("Location: blog.php");
    exit();
}

// Gestion du like
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "like" && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
    incrementLike($pdo, $article_id);
    echo getLikesCount($pdo, $article_id); // Retourner simplement le nombre de likes après l'incrémentation
    exit(); // Arrêter l'exécution après avoir augmenté le like
}

// Gestion de l'envoi de commentaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment-name'], $_POST['comment-comment'], $_POST['article_id'])) {
    $name = $_POST['comment-name'];
    $comment = $_POST['comment-comment'];
    $article_id = $_POST['article_id'];

    // Enregistrer le commentaire
    saveComment($pdo, $name, $comment, $article_id);
}

// Récupérer tous les commentaires pour cet article
$comments = getCommentsByArticleId($pdo, $article_id);

?>


<div class="fond">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img src="uploads/blog/<?= htmlspecialchars($article['image']); ?>" class="card-img-top" alt="Image de l'article">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div></div> <!-- Placeholder for left alignment -->
                            <a href="blog.php" class="btn btn-outline-dark ml-auto">Retour au blog</a>
                        </div>                    
                        <div class="text-center">
                            <h3 class="card-title"><?= htmlspecialchars($article['titre']); ?></h3>
                            <p class="card-text"><?= htmlspecialchars($article['date']); ?></p>
                        </div>
                        <p class="card-text mt-5"><?= htmlspecialchars_decode($article['sujet']); ?></p>
                        <div class="like-container">
                            <button class="btn btn-like" data-article-id="<?= $article['id']; ?>"><i class="fa-solid fa-heart" style="color: #74C0FC;"></i></button>
                            <span id="likes-count-<?= $article['id']; ?>"><?= getLikesCount($pdo, $article['id']); ?></span>
                        </div>
                        
                        <button class="btn btn-outline-dark show-comment-form ">Commenter</button>
                        <form class="comment-form mt-5" style="display: none;"  method="POST">
                            <div class="form-group">
                                <label for="comment-name">Nom</label>
                                <input type="text" class="form-control" id="comment-name" name="comment-name" required>
                            </div>
                            <div class="form-group">
                                <label for="comment-comment">Commentaire</label>
                                <textarea class="form-control" id="comment-comment" name="comment-comment" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                            <button type="submit" class="btn btn-outline-dark">Envoyer</button>
                        </form>


                        <!-- Liste des commentaires -->
                        <div class="mt-4">
                            <h5>Commentaires</h5>
                            <div class="card-columns">
                                <?php foreach ($comments as $comment) : ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text"><?= htmlspecialchars($comment['created_at']); ?></p>
                                            <h6 class="card-title"><?= htmlspecialchars($comment['name']); ?></h6>
                                            <p class="card-text"><?= htmlspecialchars($comment['comment']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript pour gérer les clics sur le bouton "Like"
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-like').forEach(button => {
            button.addEventListener('click', function() {
                const articleId = this.getAttribute('data-article-id');

                // Envoyer une requête AJAX au serveur pour incrémenter le nombre de likes
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Mettre à jour le nombre de likes affiché
                            const likesCountElement = document.getElementById('likes-count-' + articleId);
                            if (likesCountElement) {
                                likesCountElement.textContent = xhr.responseText;
                            }
                        } else {
                            console.error('Une erreur est survenue lors du traitement de la requête');
                        }
                    }
                };
                xhr.open('POST', 'like.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('action=like&article_id=' + articleId);
            });
        });
    });

    // JavaScript pour afficher/masquer le formulaire de commentaire
document.addEventListener('DOMContentLoaded', function() {
    const commentButtons = document.querySelectorAll('.show-comment-form');
    commentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const commentForm = this.nextElementSibling; // Sélectionne le formulaire suivant
            if (commentForm) {
                // Affiche ou masque le formulaire de commentaire
                commentForm.style.display = (commentForm.style.display === 'none') ? 'block' : 'none';
            }
        });
    });
});
</script>

<?php
require_once __DIR__ . "/templates/footer_fond.php";
?>
