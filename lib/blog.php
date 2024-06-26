<?php
function getAllBlog($pdo)
{
    $query = "SELECT * FROM blog ORDER BY date DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getBlogById(PDO $pdo, int $id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM blog WHERE id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function saveBlog(PDO $pdo, string $titre, string $date, string $sujet, string|null $image, int $id = null): bool
{
    if ($id === null) {
        // Insertion d'un nouveau blog
        $query = $pdo->prepare("INSERT INTO blog (titre, date, sujet, image) VALUES(:titre, :date, :sujet, :image)");
    } else {
        // Mise à jour d'un blog existant
        $query = $pdo->prepare("UPDATE blog SET titre = :titre, date = :date, sujet = :sujet, image = :image WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT); // Lier l'ID du blog
    }

    // Liaison des valeurs aux paramètres de la requête
    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':date', $date, PDO::PARAM_STR);
    $query->bindValue(':sujet', $sujet, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);

    // Exécution de la requête
    return $query->execute();  
}


function deleteBlog(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM blog WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

