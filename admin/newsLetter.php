<?php 
require_once __DIR__. "/../config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/newsLetter.php";
require_once __DIR__. "/templates/header.php";




$newsLetters = getNewsletters($pdo);



?>

<h1 class="py-3">Listes des messages clients</h1>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($newsLetters as $newsLetter) {?>
        <tr>
            <th scope="row"><?= $newsLetter["id"] ?></th>
            <td><?= $newsLetter["email"] ?></td>
            <td>
                <a href="newsletter_delete.php?id=<?=$newsLetter["id"]?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer ce mail')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>





<?php 
require_once __DIR__. "/templates/footer.php";

?>