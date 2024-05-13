<?php
session_set_cookie_params([
 'lifetime' => 3600,
 'path' => '/',
 'domain' => _DOMAIN_,
 // 'secure' => true, a rajouter quand on deploie
 'httponly' => true,
//  'samesite' => 'None', // Ajout de l'attribut SameSite
 
]);

session_start();



if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


define('ROLE_EMPLOYE', 'employe');
define('ROLE_ADMINISTRATOR', 'administrator');

function adminOnly()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    }else if($_SESSION['user']['role_name'] !== ROLE_ADMINISTRATOR){
        header('Location: ../admin/index.php');
        exit();
 }
}

function employeAndAdmin()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    } else if ($_SESSION['user']['role_name'] !== ROLE_EMPLOYE && $_SESSION['user']['role_name'] !== ROLE_ADMINISTRATOR) {
        header('Location: ../admin/index.php');
        exit();
    }
}