<?php

function getAllAlbums($pdo)
{
    $query = "SELECT * FROM album";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getAlbumById(PDO $pdo, int $id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM album WHERE album_id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}


function saveAlbum(PDO $pdo, string $titre, string $description, string|null $image, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO album (titre, description, image) VALUES(:titre, :description, :image)");
    } else {
        
        $query = $pdo->prepare("UPDATE `album` SET `titre` = :titre, `description` = :description, image= :image WHERE `album_id` = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':titre', $titre, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image',$image, PDO::PARAM_STR);
    return $query->execute();  
}

function deleteAlbum(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM album WHERE album_id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}


