<?php
// pour afficher les employés
function getUsers($pdo){
    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

//fonction suppression employé
function deleteUser(PDO $pdo, string $email):bool
{
    // Supprime l'utilisateur de la table users_role
    $queryUserRole = $pdo->prepare("DELETE FROM users_role WHERE mail_id = :email");
    $queryUserRole->bindValue(':email', $email, PDO::PARAM_STR);
    $queryUserRole->execute();
    
    //supprime l'utilisateur de la table users
    $query = $pdo->prepare("DELETE FROM users WHERE mail_id = :email");
    $query->bindValue(':email', $email, $pdo::PARAM_STR);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

 // mot de passe
function isStrongPassword($password) {
    // Vérifie si le mot de passe contient au moins une minuscule
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    // Vérifie si le mot de passe contient au moins une majuscule
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    // Vérifie si le mot de passe contient au moins un caractère spécial
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return false;
    }
    // Vérifie si le mot de passe a une longueur minimale (par exemple, 8 caractères)
    if (strlen($password) < 8) {
        return false;
    }
    return true;
}

// nouvel employé
function addUser(PDO $pdo, string $mail_id, string $name, string $firstname, string $password) {
    
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insére l'employé dans la table users
    $sqlInsertUser = "INSERT INTO users (mail_id, name, firstname, password) 
                        VALUES (:mail_id, :name, :firstname, :password)";
    $queryInsertUser = $pdo->prepare($sqlInsertUser);
    $queryInsertUser->bindValue(":mail_id", $mail_id, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":name", $name, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":password", $password, PDO::PARAM_STR);

    // Exécute la requête pour insérer l'utilisateur dans la table users
    if ($queryInsertUser->execute()) {
        // Insére le rôle "employé" dans la table users_role
        $roleId = getRoleIdByName($pdo, 'employe');; 
        $sqlInsertUserRole = "INSERT INTO users_role (mail_id, role_id) 
                                VALUES (:mail_id, :role_id)";
        $queryInsertUserRole = $pdo->prepare($sqlInsertUserRole);
        $queryInsertUserRole->bindValue(":mail_id", $mail_id, PDO::PARAM_STR);
        $queryInsertUserRole->bindValue(":role_id", $roleId, PDO::PARAM_INT);

        // Exécute la requête pour insérer le rôle de l'employé dans la table users_role
        if ($queryInsertUserRole->execute()) {
            // Inscription réussie, retournez true
            return true;
        } else {
            // Erreur lors de l'insertion du rôle
            return false;
        }
    } else {
        // Erreur lors de l'insertion de l'utilisateur
        return false;
    }
}

// Fonction pour obtenir l'ID du rôle par son nom
function getRoleIdByName(PDO $pdo, string $roleName) {
    $sqlSelectRoleId = "SELECT role_id FROM role WHERE name = :role";
    $querySelectRoleId = $pdo->prepare($sqlSelectRoleId);
    $querySelectRoleId->bindValue(":role", $roleName, PDO::PARAM_STR);
    $querySelectRoleId->execute();
    return $querySelectRoleId->fetchColumn();
}


// eviter un mail qui existe
function emailAlreadyExists(PDO $pdo, string $email) {
    
    $sql = "SELECT COUNT(*) FROM users WHERE mail_id = :email";

    $query = $pdo->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();

    // Récupérez le résultat sous forme de nombre de lignes correspondantes
    $count = $query->fetchColumn();

    // Si $count est supérieur à 0, cela signifie que l'e-mail existe déjà
    return $count > 0;
}


// fontion qui vérifie le mot de passe et lie les table users, role et users_role
function verifyUserLoginPassword(PDO $pdo, string $email, string $password):array|bool
{
    $query = $pdo->prepare("SELECT u.*, r.name AS role_name
                            FROM users u
                            INNER JOIN users_role ur ON u.mail_id = ur.mail_id
                            INNER JOIN role r ON ur.role_id = r.role_id
                            WHERE u.mail_id = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

 // verifie le mot de passe et le compare avec le hach
    if($user && password_verify($password, $user["password"])){
        return $user;
    } else {
        return false;
    }
    
}

