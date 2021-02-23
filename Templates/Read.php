<?php
    require(PATH . 'Templates/Comments.php');
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    require_once(PATH . 'Templates/ReadArticle.php');

    $article = new Article;
    $article->load($_GET['ID']);
    $article->addView();
    $article->getRelatedCategories();
    ob_start();
?>
        <div id="Content" class="d-flex justify-content-center">
<?php
    readOddComments($article->ID);
    ReadArticle($article);
    readEvenComments($article->ID);
?>
        </div>
        <input type="hidden" id="ID" value="<?=$article->ID?>">
        <input type="hidden" id="HTMLPATH" value="<?=HTMLPATH?>">
<?php
    echo ob_get_clean();