<?php 
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/lib/session.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/single.php";
require_once __DIR__ . "/lib/opinion.php";



require_once __DIR__ . "/templates/header.php";

$singles = getAllSingles($pdo);
$recentOpinion = getRecentOpinions($pdo);
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

<!-- Avis -->

<div class="">
    <div id="myCarousel" class="carousel slide mt-5" data-bs-ride="carousel" style="height: 20vh;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <svg class="bd-placeholder-img" width="100%" height="25%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#FFFFFF"></rect></svg>
                <div class="carousel-caption">
                    <h3>Les Avis</h3>
                    <p>Lisez les avis clients et mettez votre ressenti</p>
                </div>
            </div>
            <?php foreach ($recentOpinion as $key => $opinion) : ?>
                <?php require __DIR__ . "/templates/part_opinion.php"; ?>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <i class="fa-solid fa-chevron-left"></i>  
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <i class="fa-solid fa-chevron-right"></i> 
        </button>
    </div>



<?php require_once __DIR__ . "/templates/footer.php"; ?>