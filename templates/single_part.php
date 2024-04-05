<?php
    if ($single["image"] === null) {
        $imagePath = _ASSETS_IMAGES_FOLDER_."img-default.jpg";
    } else {
        $imagePath =  _SINGLES_IMAGES_FOLDER_.$single["image"];
    }
?>



<div class="item">
    <img src="<?=$imagePath ?>" alt="<?=htmlentities($single["title"]) ?>">
    <div class="content">
        <div class="author">DJPak</div>
        <div class="title"><?=htmlentities($single["title"]) ?></div>
        <div class="topic"><?=htmlentities($single["duration"]) ?></div>
        <div class="des"><?=htmlentities($single["description"]) ?> </div>
        <div class="buttons">
            <a href="A AJOUTER.php?id=<?=$single["id"];?>" class="button">Voir plus</a>
            <a href="#" class="button">Vote</a>
        </div>
    </div>
</div>