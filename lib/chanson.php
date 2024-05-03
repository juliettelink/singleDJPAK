<?php

function getChansonsByAlbumId($pdo, $albumId) {
    $query = "SELECT * FROM chanson WHERE album_id = :album_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':album_id', $albumId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}