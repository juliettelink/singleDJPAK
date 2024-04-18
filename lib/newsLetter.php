<?php

function getNewsletters(PDO $pdo){
    $sql = "SELECT * FROM newsletter_subscribers";
    $stmt = $pdo->query($sql);

    $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $forms;
}

//fonction de suppression d'un avis
function deleteNewsLetters(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM newsletter_subscribers WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}