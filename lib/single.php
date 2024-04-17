<?php 

//fonction pour le formulaire de contact avec les modèles de voitures
function getSinglesModels(PDO $pdo): array
{
    $sql = "SELECT DISTINCT title FROM sing";
    $query = $pdo->query($sql);
    $models = $query->fetchAll(PDO::FETCH_COLUMN);
    return $models;
}


function getAllSingles(PDO $pdo):array
{
    $sql = "SELECT * FROM sing ORDER BY id ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $singles = $query->fetchAll(PDO::FETCH_ASSOC);

    return $singles;
}

function getSinglesById(PDO $pdo, int $id): array|bool
{
    $query =$pdo->prepare("SELECT * FROM sing WHERE id=:id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getSingleImage(string|null $image):string
{
    if ($image === null || $image === "img_default.jpg"){
    return _ASSETS_IMAGES_FOLDER_."img_default.jpg";
} else {
    return _SINGLES_IMAGES_FOLDER_.htmlentities($image);
}
}

//fonction delet service
function deleteSingles(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM sing WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function saveSingles(PDO $pdo, string $title, string $duration, string $description, string|null $image, string $audio, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO sing (title, duration, description, image, audio) VALUES(:title, :duration, :description, :image, :audio)");
    } else {
        
        $query = $pdo->prepare("UPDATE `sing` SET `title` = :title, `duration`= :duration, `description` = :description, image= :image, audio= :audio WHERE `id` = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':duration', $duration, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':image',$image, $pdo::PARAM_STR);
    $query->bindValue(':audio',$audio, $pdo::PARAM_STR);
    return $query->execute();  
}