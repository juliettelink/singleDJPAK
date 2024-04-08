<?php 
require_once __DIR__. "/../config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/form.php";
require_once __DIR__. "/templates/header.php";




$forms = getForms($pdo);



?>

<h1 class="py-3">Listes des messages clients</h1>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nom du client</th>
        <th scope="col">Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Sujet</th>
        <th scope="col">Message</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($forms as $form) {?>
        <tr>
            <th scope="row"><?= $form["form_id"] ?></th>
            <td><?= $form["name"] ?></td>
            <td><?= $form["surname"] ?></td>
            <td><?= $form["mail"] ?></td>
            <td><?= $form["subject"] ?></td>
            <td><?= $form["message"] ?></td>
            <td><?= $form["date"] ?></td>
            <td>
                <a href="form_delete.php?id=<?=$form['form_id']?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer cet avis')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>





<?php 
require_once __DIR__. "/templates/footer.php";

?>