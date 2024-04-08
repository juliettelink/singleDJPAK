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
<div class="container">
    <h1 class="py-3">Venez écouter mes nouveautés</h1>

    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Titre</th>
                    <th scope="col" class="text-center">Durée</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Audio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($singles as $single) {?>
                <tr>
                    <th scope="row" class="text-center"><?= $single["title"] ?></th>
                    <td class="text-center"><?= $single["duration"] ?></td>
                    <td class="text-center"><img src="uploads/singles/<?= $single['image'] ?>" alt="<?= $single['title'] ?>" class="img-fluid" style="max-width: 100px;"></td>
                    <td class="text-center">
                        <audio controls>
                            <source src="assets/music/<?= $single['audio'] ?>" type="audio/mpeg">
                        </audio>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<?php
require_once __DIR__ . "/templates/footer.php";