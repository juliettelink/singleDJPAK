
<div class="carousel-item">
    <svg class="bd-placeholder-img" width="100%" height="25%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#F5EFE6"></rect></svg>
    <div class="container">
        <div class="carousel-caption">
            <p><?=htmlentities($opinion["comment"])?></p>
            <div class="recent-star-rating" data-note="<?=htmlentities($opinion["note"])?>">
                <span class="la-star" data-value="1"></span>
                <span class="la-star" data-value="2"></span>
                <span class="la-star" data-value="3"></span>
                <span class="la-star" data-value="4"></span>
                <span class="la-star" data-value="5"></span>
            </div>
        </div>
    </div>
</div>
