<?php 
require_once __DIR__. "/../config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/opinion.php";
require_once __DIR__. "/templates/header.php";





$opinions = getOpinions($pdo);



?>

<h1 class="py-3">Listes des avis</h1>

<div class="d-flex gap-é justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="opinion.php">
        Ajouter un avis
    </a>
</div>
<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nom du client</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Note</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($opinions as $opinion) {?>
        <tr>
            <th scope="row"><?= $opinion["opinion_id"] ?></th>
            <td><?= $opinion["nameClient"] ?></td>
            <td><?= $opinion["comment"] ?></td>
            <td><?= $opinion["note"] ?></td>
            <td><?= $opinion["date"] ?></td>
            <td>
                <a href="opinion.php?id=<?=$opinion['opinion_id']?>" class="btn btn-outline-success">Modifier</a>
                <a href="opinion_delete.php?id=<?=$opinion['opinion_id']?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer cet avis')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>





<?php 
require_once __DIR__. "/templates/footer.php";

?>