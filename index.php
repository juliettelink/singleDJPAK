<?php 
require_once __DIR__ . "/lib/config.php";
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
                
                <div class="item">
                    <img src="uploads/singles/img1.jpg">
                    <div class="content">
                        <div class="author">LUNDEV</div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">ANIMAL</div>
                        <div class="des">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <a href="#" class="button">Voir plus</a>
                            <a href="#" class="button">Vote</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img2.jpg">
                    <div class="content">
                        <div class="author">LUNDEV</div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">ANIMAL</div>
                        <div class="des">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img3.jpg">
                    <div class="content">
                        <div class="author">LUNDEV</div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">ANIMAL</div>
                        <div class="des">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img4.jpg">
                    <div class="content">
                        <div class="author">LUNDEV</div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">ANIMAL</div>
                        <div class="des">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img5.jpg">
                    <div class="content">
                        <div class="author">LUNDEV</div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">ANIMAL</div>
                        <div class="des">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- list thumnail -->
            <div class="thumbnail">
                <div class="item">
                    <img src="uploads/singles/img1.jpg">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img2.jpg">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img3.jpg">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img4.jpg">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="uploads/singles/img5.jpg">
                    <div class="content">
                        <div class="title">
                            Name Slider
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- next prev -->

            <div class="arrows">
                <button id="prev"><</button>
                <button id="pause" class="play">▶</button>
                <button id="next">></button>
            </div>
            <!-- time running -->
            <div class="time"></div>
        </div>

<?php require_once __DIR__ . "/templates/footer.php"; ?>