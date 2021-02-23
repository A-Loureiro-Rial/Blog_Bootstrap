<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    $article = new Article($_POST['Title'], $_POST['Author'], $_POST['Content']);
    $article->save();
    if (isset($_POST['Cat']))
    {
        foreach($_POST['Cat'] as $Cat)
        {
            $article->addCategory($Cat);
        }
    }
?>
        <div class="d-flex justify-content-center align-content-center p-5 m-5 alert alert-success" role="alert">
            <p class="text-center">
                    <strong>Well done!</strong> Your article has been created!<br><br>
                    You will be redirected in  <span id="count">5</span>
                </p>
                <input type="hidden" id="htmlpath" value="<?=HTMLPATH?>">
        </div>
        <div class="d-flex justify-content-center align-content-center p-5 m-5">
            <div class="spinner-border text-info d-flex justify-content-center" role="status"></div>
        </div>
        <input type="hidden" name="ID" id="ID" value="<?=$article->ID?>">
