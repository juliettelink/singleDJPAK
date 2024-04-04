<?php 
require_once __DIR__. "/../lib/config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/single.php";
require_once __DIR__. "/templates/header.php";



$singles = getAllSingles($pdo);
var_dump($singles);
?>

<h1 class="py-3">Listes des singles</h1>

<div class="d-flex gap-é justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="single.php">
        Ajouter un single
    </a>
</div>
<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Durée</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($singles as $single) {?>
        <tr>
        <th scope="row"><?= $single["id"] ?></th>
        <td><?= $single["title"] ?></td>
        <td><?= $single["duration"] ?></td>
        <td><?= $single["description"] ?></td>
        <td><img src="<?= "../assets/images/". $single["image"] ?>" alt="image single" width="30" height="30"></td>
        <td>
            <a href="single.php?id=<?=$single['id']?>" class="btn btn-outline-success">Modifier</a>
            <a href="single_delete.php?id=<?=$single['id']?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer ce single')">Supprimer</a>
        </td>
        <?php } ?>
        </tr>
    </tbody>
    </table>

<?php 
require_once __DIR__. "/templates/footer.php";

?>