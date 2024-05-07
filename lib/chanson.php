<?php
function getChansonsByAlbumId($pdo, $albumId) {
    $query = "SELECT * FROM chanson WHERE album_id = :album_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':album_id', $albumId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getChansonbyId(PDO $pdo, int $id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM chanson WHERE chanson_id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function deleteChanson(PDO $pdo, int $id): bool
{
    $query = $pdo->prepare("DELETE FROM chanson WHERE chanson_id = :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}


function saveChanson($pdo, $albumId, $titre, $audioFileName, $imageFileName = null)
{
    var_dump($albumId, $titre, $audioFileName, $imageFileName); // Ajoutez ceci pour vérifier les valeurs des paramètres

    // Préparer la requête SQL pour insérer la chanson dans la base de données
    $query = "INSERT INTO chanson (album_id, titre, audio, image) VALUES (:album_id, :titre, :audio, :image)";
    // Préparer les paramètres de la requête
    $params = [
        'album_id' => $albumId,
        'titre' => $titre,
        'audio' => $audioFileName,
        'image' => $imageFileName
    ];

    // Exécuter la requête avec les paramètres
    $statement = $pdo->prepare($query);
    $success = $statement->execute($params);

    var_dump($success); // Ajoutez ceci pour vérifier si l'insertion a réussi ou non

    return $success; // Retourner true si l'insertion a réussi, sinon false
}