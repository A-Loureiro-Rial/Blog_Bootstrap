<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    require(PATH . 'functions/Edit.php');
    $article = new article;
    $article->load($_POST['ID']);
    $article->Title = $_POST['Title'];
    $article->Author = $_POST['Author'];
    $article->Content = $_POST['Content'];
    $article->update();
    $article->getRelatedCategories();
    foreach($article->CategoryList as $Linked)
    {
        if (!in_array($Linked, $_POST))
        {
            $article->removeCategory($Linked->CategoryID);
        }
    }
    foreach ($_POST['Cat'] as $needed)
    {
        if (isNeeded($article, $needed))
        {
            $article->addCategory($needed);
        }
    }
?>
        <div class="d-flex justify-content-center align-content-center p-5 m-5 alert alert-success" role="alert">
            <p class="text-center">
                    <strong>Well done!</strong> Your article has been modified!<br><br>
                    You will be redirected in  <span id="count">5</span>
                </p>
                <input type="hidden" id="htmlpath" value="<?=HTMLPATH?>">
        </div>
        <div class="d-flex justify-content-center align-content-center p-5 m-5">
            <div class="spinner-border text-info d-flex justify-content-center" role="status"></div>
        </div>
        <input type="hidden" name="ID" id="ID" value="<?=$article->ID?>">
