<?php

require_once __DIR__ . "/config.php";

require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/form.php";
require_once __DIR__ . "/lib/single.php";
require_once __DIR__ . "/lib/session.php";

require_once __DIR__ . "/templates/header.php";



$singles = getAllSingles($pdo);

?>
<div class="fond">
    <div class="container  py-5">
        <h1 class="">Venez écouter mes nouveautés</h1>

        <div class="table-responsive py-5">
            <table class="table table-transparent">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Titre</th>
                        <th scope="col" class="text-center">Durée</th>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Audio</th>
                        <th scope="col" class="text-center">Téléchargement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($singles as $single) {?>
                    <tr>
                        <th scope="row" class="text-center"><?= $single["title"] ?></th>
                        <td class="text-center"><?= $single["duration"] ?></td>
                        <td class="text-center"><img src="uploads/singles/<?= $single['image'] ?>" alt="<?= $single['title'] ?>" class="img-fluid" style="max-width: 150px;"></td>
                        <td class="text-center">
                            <audio controls>
                                <source src="assets/music/<?= $single['audio'] ?>" type="audio/mpeg">
                            </audio>
                        </td>
                        <td class="text-center"> <!-- Ajoutez une cellule pour le lien de téléchargement -->
                            <a href="assets/music/<?= $single['audio'] ?>" download="<?= $single['title'] ?>" class=" btn btn-dark text-white">Télécharger</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php
    require_once __DIR__ . "/templates/footer_fond.php";