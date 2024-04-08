<?php



function getOpinions(PDO $pdo){
    $sql = "SELECT * FROM opinions";
    $stmt = $pdo->query($sql);

    $opinions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $opinions;
}

function getRecentOpinions($pdo){
    $sql = "SELECT * FROM opinions ORDER BY opinion_id DESC LIMIT 10";
    $stmt = $pdo->query($sql);
    $recentOpinions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $recentOpinions; 
}

function findOpinionById(PDO $pdo, int $id): ?array
{
   $sql = "SELECT * FROM opinions WHERE opinion_id = :id";
   $stmt = $pdo->prepare($sql);
   $stmt->bindParam(':id', $id, PDO::PARAM_INT);
   $stmt->execute();

   $opinion = $stmt->fetch(PDO::FETCH_ASSOC);
    return $opinion ? $opinion : null;
}

//fonction delet avis
function deleteOpinion(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM opinions WHERE opinion_id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

//fonction sauvegarde avis
function saveOpinion($pdo, $nameClient, $comment, $note, $date, $id = null)
{
    try {
        if ($id === null) {
            // Si l'ID est null, il s'agit d'une nouvelle avis, donc nous insérons une nouvelle entrée.
            $query = "INSERT INTO opinions (nameClient, comment, note, date) VALUES (:nameClient, :comment, :note, :date)";
        } else {
            // Sinon, il s'agit d'une mise à jour d'avis existante.
            $query = "UPDATE opinions SET nameClient = :nameClient, comment = :comment, note = :note, date = :date WHERE opinion_id = :id";
        }

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nameClient', $nameClient, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        if ($id !== null) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();

        // Retournez true pour indiquer que l'opinion a été sauvegardée avec succès.
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, retournez false et vous pouvez gérer l'erreur plus tard.
        return false;
    }
}