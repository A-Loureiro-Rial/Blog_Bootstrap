<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    $CatList = Category::ExportAll();
    ob_start();
?>
        <h2 class="text-center text-info my-5">Select your Category or an Article related to it!</h2>
        <div class="d-flex flex-wrap m-5 justify-content-around">
            <button type="button" class="btn btn-warning" onclick="addCat()">Create my own Category!</button>
        </div>
        <div class="d-flex flex-wrap m-5 justify-content-around">
<?php
    foreach ($CatList as $Cat)
    {
        $Cat->getRelatedArticles();
?>
            <div class="btn-group">
                <a href="<?=HTMLPATH . 'Views/ReadCat.php?ID=' . $Cat->CategoryID?>"><button type="button" class="btn btn-success"><?=$Cat->CategoryName?></button></a>
                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu">
                    <h6 class="dropdown-header">Articles related</h6>
<?php
        foreach($Cat->ArticleList as $Article)
        {
?>
                    <a class="dropdown-item" href="<?=HTMLPATH . 'Views/Read.php?ID=' . $Article->ID?>"><?=$Article->Title?></a>
<?php
        }
?>
                </div>
            </div>
<?php
    }
?>
        </div>
        <input type="hidden" id="htmlpath" value="<?=HTMLPATH?>">
<?php
    echo ob_get_clean();
?>