<?php

function getForms(PDO $pdo){
    $sql = "SELECT * FROM forms";
    $stmt = $pdo->query($sql);

    $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $forms;
}

//fonction de suppression d'un avis
function deleteForm(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM forms WHERE form_id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}