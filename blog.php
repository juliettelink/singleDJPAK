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
        <h1 class="text-center py-5">Actualité</h1>


        <div class="row">
            <?php foreach ($blogs as $blog) {?>

            <div class="col-md-3 mb-4 justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="uploads/blog/<?= $blog['image']; ?>" class="card-img-top" alt="image couverture album">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $blog['titre']; ?></h5>
                        <p class="card-text"><?= $blog['date']; ?></p>
                        <p class="card-text"><?= $blog['sujet']; ?></p>
                        <button class="btn btn-dark btn-toggle my-3" data-album="<?php echo $blog['id']; ?>">a garder?</button>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>


    <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-body-secondary">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
  </div>




    <?php
  
    require_once __DIR__ . "/templates/footer_fond.php";
    ?>
