<?php
require_once __DIR__ . "/../lib/session.php";
require_once __DIR__ . '/../lib/menu.php';

$currentPage = basename($_SERVER["SCRIPT_NAME"]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$mainMenu[$currentPage]["meta_description"]?>">
    <title><?=$mainMenu[$currentPage]["head_title"]?></title>
    <title>Musique DJPak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="index.php">
            <img width="50px" src="assets/images/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($mainMenu as $key => $menuItem) : ?>
                    <?php if (!array_key_exists("exclude", $menuItem)) : ?>
                        <li class="nav-item <?= ($key === $currentPage) ? 'active' : ''; ?>">
                            <a href="<?= $key ?>" class="nav-link"><?= $menuItem["menu_title"]; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="navbar-nav">
    <!-- Boutons de lecture et de pause stylisés avec une image -->
            <button id="play-pause" class="play">
                <img src="chemin/vers/votre/image.png" alt="Play" id="play-icon">
            </button>
        </div>
    </nav>
</div>
                
<div class="navbar-nav">
    <audio id="myAudio" autoplay controls style="display: none;">
        <source src="assets/music/intro.MP3" type="audio/mpeg">
        Votre navigateur ne supporte pas l'élément audio.
    </audio>
</div>
<!--fin navbar-->

<main>