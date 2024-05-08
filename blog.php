<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . "/lib/blog.php";



require_once __DIR__ . "/templates/header.php";

$blogs = getAllBlog($pdo);


?>
<div class="fond">
    <div class="container py-5">
        <h1 class="text-center py-5">Blog</h1>


        <div class="row">
            <?php foreach ($blogs as $blog) {?>

            <div class="col-md-5 col-sm-5 mb-5 ">
                <div class="card" style="width: 28rem;">
                    <img src="uploads/blog/<?= $blog['image']; ?>" class="card-img-top" alt="image couverture album">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $blog['titre']; ?></h5>
                        <p class="card-text"><?= $blog['date']; ?></p>
                        <p class="card-text"><?= substr($blog['sujet'], 0, 100); ?>... <a href="article.php?id=<?= $blog['id']; ?>">Lire la suite</a></p>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>


  </div>




    <?php
  
    require_once __DIR__ . "/templates/footer_fond.php";
    ?>
