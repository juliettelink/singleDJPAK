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
    <div class="container  py-5">
        <h1 class="">Venez écouter mes nouveautés</h1>
        <p> Pour télécharger gratuitement il suffit de cliquer sur le bouton, rentrer votre mail et vous pourrez télécharger ma musique</p>

        <div class="table-responsive py-5">
            <table class="table table-transparent">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Titre</th>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Audio</th>
                        <th scope="col" class="text-center">Téléchargement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($singles as $single) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $single["title"] ?></th>
                        <td class="text-center"><img src="uploads/singles/<?= $single['image'] ?>" alt="<?= $single['title'] ?>" class="img-fluid" style="max-width: 150px;"></td>
                        <td class="text-center">
                            <audio controls>
                                <source src="assets/music/<?= $single['audio'] ?>" type="audio/mpeg">
                            </audio>
                        </td>
                        <td class="text-center"> <!-- Ajoutez une cellule pour le lien de téléchargement -->
                            <?php if (isset($_SESSION['newsletter_subscribers']) && $_SESSION['newsletter_subscribers'] === true) { ?>
                                
                                <a href="assets/music/<?= $single['audio'] ?>" download="<?= $single['title'] ?>" class="btn btn-dark text-white">Télécharger</a>
                            <?php } else { ?>
                                <a href="newsLetter.php" class="btn btn-dark text-white"> Télécharger</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
  
    require_once __DIR__ . "/templates/footer_fond.php";