<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/album.php";
require_once __DIR__ . "/lib/chanson.php";


require_once __DIR__ . "/templates/header.php";

$albums = getAllAlbums($pdo);


?>
<div class="fond">
    <div class="container py-5">
        <h1 class="text-center">Découvrez les albums</h1>
        <p class="text-center">Pour télécharger gratuitement, il suffit de cliquer sur le bouton, de rentrer votre mail et vous pourrez télécharger ma musique.</p>

        <div class="row">
            <?php foreach ($albums as $album) {?>

            <div class="col-md-4 mb-3">
                <div class="card" style="width: 25rem;">
                    <img src="assets/albums/pochettes/<?= $album['image']; ?>" class="card-img-top" alt="image couverture album">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $album['titre']; ?></h5>
                        <p class="card-text"><?= $album['description']; ?></p>
                        <button class="btn btn-dark btn-toggle my-3" data-album="<?php echo $album['album_id']; ?>">Voir les chansons</button>
                        <div class="songs" style="display: none;">
                            <?php $chansons = getChansonsByAlbumId($pdo, $album['album_id']);
                            foreach ($chansons as $chanson) { ?>
                                <div class="song">
                                    <h6 class="song-title"><?=$chanson['titre']; ?></h6>
                                    <audio controls style="width: 50%;">
                                        <source src="assets/albums/chansons/<?= $chanson['audio']; ?>" type="audio/mpeg">
                                        Votre navigateur ne prend pas en charge l'élément audio.
                                    </audio>
                                    <?php if (isset($_SESSION['newsletter_subscribers']) && $_SESSION['newsletter_subscribers'] === true) { ?>
                                        <a href="assets/albums/chansons/<?=$chanson['audio']; ?>" download>Télécharger</a>
                                    <?php } else { ?>
                                        <a href="newsLetter.php" class="btn btn-dark text-white">Télécharger</a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>




    <?php
  
    require_once __DIR__ . "/templates/footer_fond.php";
    ?>



<script>
    // Récupérez tous les boutons de toggle
    const toggleButtons = document.querySelectorAll('.btn-toggle');

    // Ajoutez un événement de clic à chaque bouton de toggle
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérez le parent de ce bouton (l'élément .card)
            const card = this.closest('.card');
            // Récupérez l'élément .songs de cet album
            const songs = card.querySelector('.songs');
            // Inversez la visibilité de l'élément .songs
            if (songs.style.display === 'none') {
                songs.style.display = 'block';
                this.textContent = 'Masquer les chansons';
            } else {
                songs.style.display = 'none';
                this.textContent = 'Voir les chansons';
            }
        });
    });
</script>


