<?php 
require_once __DIR__. "/../config.php";
require_once __DIR__. "/../lib/session.php";

require_once __DIR__. "/../lib/pdo.php";
require_once __DIR__. "/../lib/blog.php";
require_once __DIR__. "/../lib/like.php"; 
require_once __DIR__. "/templates/header.php";

adminOnly();

$blogs =  getAllBlog($pdo);

?>

<h1 class="py-3">Blog</h1>

<div class="d-flex gap-é justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="blog.php">
        Ajouter un blog
    </a>
</div>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Titre</th>
        <th scope="col">Sujet</th>
        <th scope="col">Images</th>
        <th scope="col">Likes</th>
        <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($blogs as $blog) {?>
        <tr>
            <th scope="row"><?= $blog["id"] ?></th>
            <td><?= $blog["date"] ?></td>
            <td><?= $blog["titre"] ?></td>
            <td><?= substr($blog["sujet"], 0, 50) . (strlen($blog["sujet"]) > 50 ? "..." : "") ?></td>
            <td><img src="../uploads/blog/<?= $blog['image'] ?>" alt="<?= $blog['titre'] ?>" width="50"></td>
            <td><?= getLikesCount($pdo, $blog['id']); ?></td> 
            <td>
            <a href="blog.php?id=<?=$blog['id']?>" class="btn btn-outline-success">Modifier</a>
            <a href="blog_delete.php?id=<?=$blog['id']?>" class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de vouloir supprimer ce message')">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>





<?php 
require_once __DIR__. "/templates/footer.php";

?>