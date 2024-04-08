<?php 
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/single.php";


require_once __DIR__ . "/templates/header.php";

$singles = getAllSingles($pdo);
?>

<!-- carousel -->
<div class="carousel">
    <!-- list item -->
    <div class="list">
        <?php foreach ($singles as $key => $single) : ?>
            <?php require __DIR__ . "/templates/single_part.php"; ?>
        <?php endforeach; ?>
    </div>
    <!-- list thumnail -->
    <div class="thumbnail">
        <?php require __DIR__ . "/templates/thumbnail_part.php"; ?>
    </div>
    <!-- next prev -->

    <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <!-- time running -->
    <div class="time"></div>
</div>



<?php require_once __DIR__ . "/templates/footer.php"; ?>