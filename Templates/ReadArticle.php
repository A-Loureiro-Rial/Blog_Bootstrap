<?php
    require_once(PATH . 'Templates/Edit.php');
    function ReadArticle($article)
    {
?>
            <div class="card m-2 w-50 order-2">
            <img class="card-img-top h-10" src="<?=HTMLPATH . 'Src/Medias/Images/articles.jpg'?>" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title font-weight-bold text-wrap"><?=$article->Title?></h4>
                <h6 class="card-subtitle mb-2 text-muted text-wrap">An article by <span class="font-italic"><?=$article->Author?></span></h6><br>
                <p class="card-text text-wrap text-center">
                    <?=$article->Content?>

                </p>
                <span class="font-weight-light text-muted text-center">
                        Viewed <?=$article->Views?> Times<br>
                        Last Update: <?=$article->UpdateDate?><br>
                        Creation Date: <?=$article->CreationDate?><br><br>
                        Categories<br>
                        <span class="font-weight-bold text-muted text-center">
<?php
foreach($article->CategoryList as $Cat)
{
?>
                            '<a href="<?=HTMLPATH . 'Views/ReadCat.php?ID=' . $Cat->CategoryID?>"><?=$Cat->CategoryName?></a>' 
<?php
}
?>
                        </span>
                <br></span><br>
                <div class="d-flex flex-column justify-content-center" id="buttons">
                    <div id="articleButtons" class="d-flex justify-content-center">
<?php
EditButton($article);
?>
                        <button type="button" class="m-2 btn btn-danger" onclick="deleteArticle(<?=$article->ID?>, '<?=$article->Title?>')">Delete</button>
                    </div>
                    <button type="button" class="btn btn-info w-20 m-2" onclick="addComment(<?=$article->ID?>)">Comment</button>
                </div>
            </div>
        </div>
<?php
    }
?>