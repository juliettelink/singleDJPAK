

<?php foreach ($singles as $single) : ?>
    <div class="item">
        <img src="uploads/singles/<?= $single['image'] ?>" alt="<?=htmlentities($single['title'])?>">
        <div class="content">
            <div class="title"><?=htmlentities($single['title']) ?></div>
        </div>
    </div>
<?php endforeach; ?>