<?php

function getChansonsByAlbumId($pdo, $albumId) {
    $query = "SELECT * FROM chanson WHERE album_id = :album_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':album_id', $albumId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function deleteChanson(PDO $pdo, int $chanson_id): bool
{
    $query = $pdo->prepare("DELETE FROM chanson WHERE chanson_id = :chanson_id");
    $query->bindValue(':chanson_id', $chanson_id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    $success = $query->execute();

    return $success; // Retourner true si la suppression a été effectuée avec succès, sinon false
}


// Fonction pour enregistrer un fichier dans un dossier spécifique
function saveFile($tmpName, $folder)
{
    // Générer un nom de fichier unique
    $fileName = uniqid() . '-' . basename($tmpName);
    $targetPath = dirname(__DIR__) . $folder . $fileName;

    // Déplacer le fichier téléchargé vers le dossier cible
    if (move_uploaded_file($tmpName, $targetPath)) {
        return $fileName; // Retourner le nom de fichier si l'enregistrement est réussi
    } else {
        return false; // Retourner false en cas d'échec de l'enregistrement
    }
}


function saveChanson($pdo, $albumId, $titre, $audioFileName, $imageFileName = null)
{
    // Préparer la requête SQL
    $query = "INSERT INTO chanson (album_id, titre, audio";

    // Si une image est fournie, ajouter le champ image à la requête
    if ($imageFileName !== null) {
        $query .= ", image";
    }

    $query .= ") VALUES (:album_id, :titre, :audio";

    // Si une image est fournie, ajouter le paramètre image à la requête
    if ($imageFileName !== null) {
        $query .= ", :image";
    }

    $query .= ")";

    // Préparer les paramètres de la requête
    $params = [
        'album_id' => $albumId,
        'titre' => $titre,
        'audio' => $audioFileName
    ];

    // Si une image est fournie, ajouter le paramètre image
    if ($imageFileName !== null) {
        $params['image'] = $imageFileName;
    }

    // Exécuter la requête avec les paramètres
    $statement = $pdo->prepare($query);
    $success = $statement->execute($params);

    return $success; // Retourner true si l'insertion a réussi, sinon false
}

