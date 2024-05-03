<?php

function getAllAlbums($pdo)
{
    $query = "SELECT * FROM album";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}