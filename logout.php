<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
//pour la deconnection
session_destroy();
unset($_SESSION);
header('Location: login.php');
