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
<div class="music">
    <div class="container">
        <h1 class="py-3">Venez écouter mes nouveautés</h1>

        <div class="table-responsive">
            <table class="table table-secondary">
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
                            <a href="assets/music/<?= $single['audio'] ?>" download="<?= $single['title'] ?>" class="text-dark">Télécharger</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-4">
    <div class="col-md-4 d-flex align-items-center">
        <img src="assets/images/logo.png" alt="Votre Logo" class="mb-3 me-2 mb-md-0" width="30" height="24">
        <span class="mb-3 mb-md-0 text-body-secondary">2023 DJPAK, Inc</span>
    </div>
    <div class=" ">
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="logout.php" class="nav-link">Déconnexion</a>
        <?php else : ?>
            <a href="login.php" class="nav-link">Espace Pro</a>
        <?php endif; ?>
    </div>


    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex align-items-center">
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://open.spotify.com/intl-fr/artist/7L70NlXQPcsZrGWo2SCE9G"><img src="assets/images/spotify.png" alt="Spotify" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://on.soundcloud.com/S4mfY"><img src="assets/images/soundCloud.png" alt="Souncloud" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.youtube.com/results?search_query=djpak"><img src="assets/images/youtube.png" alt="YouTube" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.tiktok.com/@djpakafro?_t=8lPlQKN5Pay&_r=1"><img src="assets/images/tiktok.png" alt="TikTok" width="26"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.instagram.com/djpakafro/"><img src="assets/images/instagram.jpg" alt="Instagram" width="34"></a></li>
    </ul>
    </footer>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="assets/js/musicHome.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/opinionScript.js"></script>
<!-- <script src="/assets/js/private_politicy.js"></script> -->

</body>
</html>
