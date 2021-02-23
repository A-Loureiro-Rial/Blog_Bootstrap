<?php
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    $Cat = new Category;
    $Cat->load($_GET['ID']);
    $Cat->getRelatedArticles();
?>
        <div class="card m-5 d-flex justify-content-center">
            <div class="card-body m-5">
                <h2 class="card-title text-info font-weight-bold my-4" id="CatTitle"><?=$Cat->CategoryName?></h2>
                <h6 class="text-info">Description</h6>
                <p class="card-text mx-3" id="CatDescription">
                    <?=$Cat->CategoryDescription?><br><br>
                </p>
                <div class="Buttons">
                <button type="button" class="btn btn-primary" onclick="editCat(<?=$Cat->CategoryID?>)">Edit</button>
                <button type="button" class="btn btn-danger" onclick="deleteCat(<?=$Cat->CategoryID?>)">Delete</button>
                </div><br><br>
                <h4 class="text-info">Articles Related</h4>
                <div class="list-group w-25">
<?php
    foreach ($Cat->ArticleList as $Art)
    {
?>
                    <a href="<?=HTMLPATH . 'Views/Read.php?ID=' . $Art->ID?>" class="list-group-item list-group-item-action text-wrap">
                        "<?=$Art->Title?>" by <span class="font-italic"><?=$Art->Author?></span></a>
<?php
    }
?>
                </div>
            </div>
        </div>
        <input type="hidden" id="htmlpath" value="<?=HTMLPATH?>">