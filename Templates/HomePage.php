<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    $Famous = Article::ExportPopular();
?>

<h1 class="text-center text-info">Famous articles</h1>
<div class="container shadow-lg rounded">
    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block w-100 rounded" data-src="holder.js/1000x300?auto=yes&amp;bg=777&amp;fg=555&amp;text=First slide" alt="First slide [1000x300]" src="<?=HTMLPATH . 'Src/Medias/Images/caroussel.jpg'?>" data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-dark"><?=$Famous[0]->Title?></h2>
                        <p class="text-break text-dark text-muted">
                            An Article by <span class="font-italic"><?=$Famous[0]->Author?></span><br><br>
                            Viewed <?=$Famous[0]->Views?> Times<br><br>
                            Creation Date: <?=$Famous[0]->CreationDate?><br>
                            Last Update: <?=$Famous[0]->UpdateDate?><br>
                        </p>
                        <a href="<?=HTMLPATH . 'Views/Read.php?ID=' . $Famous[0]->ID?>">
                            <button type="button" class="btn btn-info">Read</button>
                        </a><br><br>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 rounded" data-src="holder.js/1000x300?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide" alt="Second slide [1000x300]" src="<?=HTMLPATH . 'Src/Medias/Images/caroussel.jpg'?>" data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-dark"><?=$Famous[1]->Title?></h2>
                        <p class="text-break text-dark text-muted">
                            An Article by <span class="font-italic"><?=$Famous[1]->Author?></span><br><br>
                            Viewed <?=$Famous[1]->Views?> Times<br><br>
                            Creation Date: <?=$Famous[1]->CreationDate?><br>
                            Last Update: <?=$Famous[1]->UpdateDate?><br>
                        </p>
                        <a href="<?=HTMLPATH . 'Views/Read.php?ID=' . $Famous[1]->ID?>">
                            <button type="button" class="btn btn-info">Read</button>
                        </a><br><br>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 rounded" data-src="holder.js/1000x300?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide" alt="Second slide [1000x300]" src="<?=HTMLPATH . 'Src/Medias/Images/caroussel.jpg'?>" data-holder-rendered="true">
                    <div class="carousel-caption d-none d-md-block">
                    <h2 class="font-weight-bold text-dark text-wrap"><?=$Famous[2]->Title?></h2>
                        <p class="text-break text-dark text-muted">
                            An Article by <span class="font-italic"><?=$Famous[2]->Author?></span><br><br>
                            Viewed <?=$Famous[2]->Views?> Times<br><br>
                            Creation Date: <?=$Famous[2]->CreationDate?><br>
                            Last Update: <?=$Famous[2]->UpdateDate?><br>
                        </p>
                        <a href="<?=HTMLPATH . 'Views/Read.php?ID=' . $Famous[2]->ID?>">
                            <button type="button" class="btn btn-info">Read</button>
                        </a><br><br>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>