<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/chanson.php";

adminOnly();

if (isset($_GET['id'])) {
    $chansonId = $_GET['id'];
    
    // Supprimer la chanson
    $success = deleteChanson($pdo, $chansonId);

    if ($success) {
        // Rediriger vers la page précédente (albums.php)
        header("Location: albums.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression de la chanson.";
    }
} else {
    echo "ID de chanson non spécifié.";
}
?>