<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/form.php";
require_once __DIR__ . "/lib/single.php";

require_once __DIR__ . "/templates/header.php";


$singles = getAllSingles($pdo);

?>
<div class="fond">
    <div class="container py-5">
        <h1 class="text-center">Venez écouter mes nouveautés</h1>
        <p class="text-center">Pour télécharger gratuitement, il suffit de cliquer sur le bouton, de rentrer votre mail et vous pourrez télécharger ma musique.</p>

        <div class="list-group py-5">
            <?php foreach($singles as $single) {?>
                <div class="list-group-item bg-transparent">
                    <div class="row align-items-center"> <!-- Utilisation d'une rangée pour aligner verticalement -->
                        <div class="col-md-4 text-center"> <!-- Colonne pour l'image -->
                            <h5 class="mb-1"><?= $single["title"] ?></h5>
                            <img src="uploads/singles/<?= $single['image'] ?>" alt="<?= $single['title'] ?>" class="img-fluid mx-auto d-block mb-2" style="max-width: 150px;"> <!-- Centrage horizontal de l'image avec une marge -->
                        </div>
                        <div class="col-md-4 text-center"> <!-- Colonne pour le lecteur audio -->
                            <audio controls class="mx-auto d-block mb-2 audioPlayer"> <!-- Centrage horizontal de l'audio -->
                                <source src="assets/music/<?= $single['audio'] ?>" type="audio/mpeg">
                            </audio>
                        </div>
                        <div class="col-md-4 text-center"> <!-- Colonne pour le bouton de téléchargement -->
                            <div class="mt-2"> <!-- Centrage vertical -->
                                <?php if (isset($_SESSION['newsletter_subscribers']) && $_SESSION['newsletter_subscribers'] === true) { ?>
                                    <a href="assets/music/<?= $single['audio'] ?>" download="<?= $single['title'] ?>" class="btn btn-dark text-white">Télécharger</a>
                                <?php } else { ?>
                                    <a href="newsLetter.php" class="btn btn-dark text-white">Télécharger</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


</div>





    <?php
  
    require_once __DIR__ . "/templates/footer_fond.php";