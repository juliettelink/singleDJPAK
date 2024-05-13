<div class="item">
    <img src="uploads/singles/<?= $single['image'] ?>" alt="<?=htmlentities($single['title']) ?>">
    <div class="content">
        <div class="author">DJPak</div>
        <div class="title"><?=htmlentities($single["title"]) ?></div>   
        <div class="des"><?=htmlspecialchars($single["description"]) ?> </div>
        <div class="buttons">
            <a href="music.php?id=<?=$single["id"];?>" class="button">Voir plus</a>
            <a href="newsLetter.php" class="button">Newsletter</a>
        </div>
        <br>
        <br>
        <div><h1> <span style="font-weight: bold; color: purple;">Téléchargement Gratuit</h1></div>
    </div>
</div>