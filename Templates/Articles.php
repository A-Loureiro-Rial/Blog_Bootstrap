<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    require_once(PATH . 'Templates/Create.php');
    $articleslist = Article::ExportAll();
    ob_start();
?>
        <div class="d-flex justify-content-center my-2">
<?php
CreateButton();
?>
            <div id="articlelist" class="d-flex flex-wrap justify-content-center">
<?php
    foreach ($articleslist as $article)
    {
?>
                <div class="card m-2 w-25">
                    <img class="card-img-top h-25" src="<?=HTMLPATH . 'Src/Medias/Images/articles.jpg'?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold text-wrap"><?=$article->Title?></h4>
                            <h6 class="card-subtitle mb-2 text-muted text-wrap">An article by <span class="font-italic"><?=$article->Author?></span></h6><br>
                            <span class="font-weight-light text-muted">
                                Viewed <?=$article->Views?> Times<br>
                                Last Update: <?=$article->UpdateDate?><br>
                                Creation Date: <?=$article->CreationDate?><br>
                            </span>
                        <a href="<?=HTMLPATH . 'Views/Read.php?ID=' . $article->ID?>" class="btn btn-info my-2">Read</a>
                    </div>
                </div>
<?php
    }
    echo ob_get_clean();
?>
</div>