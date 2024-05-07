<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__. "/../lib/session.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/album.php";
require_once __DIR__ . "/../lib/chanson.php";
require_once __DIR__ . "/templates/header.php";

 adminOnly();

$albums = getAllAlbums($pdo);

?>

<h1 class="py-3">Liste des albums avec les chansons associées</h1>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Liste des albums</h2>
    <a href="album.php" class="btn btn-primary">Ajouter un album</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Sons</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($albums as $album) {?>
            <tr>
                <th scope="row"><?= $album["album_id"] ?></th>
                <td><?= $album["titre"] ?></td>
                <td><?= $album["description"] ?></td>
                <td><img src="../assets/albums/pochettes/<?= $album['image'] ?>" alt="<?= $album['titre'] ?>" width="50"></td>
                <td>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Audio</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $chansons = getChansonsByAlbumId($pdo, $album['album_id']); ?>
                            <?php foreach ($chansons as $chanson) { ?>
                                <tr>
                                    <td><?= $chanson['titre']; ?></td>
                                    <td>
                                        <audio controls>
                                            <source src="../assets/albums/chansons/<?= $chanson['audio']; ?>" type="audio/mpeg">
                                            Votre navigateur ne supporte pas l'audio HTML5.
                                        </audio>
                                    </td>
                                    <td><img src="../assets/albums/pochettes/<?= $chanson['image']; ?>" alt="<?= $chanson['titre']; ?>" width="50"></td>
                                    <td>
                                        <a href="chanson_delete.php?id=<?= $chanson['chanson_id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la chanson ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
                <td>
                    <a href="album.php?id=<?= $album['album_id'] ?>" class="btn btn-outline-primary">Modifier l'album</a>
                    <a href="album_delete.php?id=<?= $album['album_id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet album ?')">Supprimer l'album</a>
                    <a href="chanson.php" class="btn btn-primary">Ajouter un son</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once __DIR__. "/templates/footer.php"; ?>