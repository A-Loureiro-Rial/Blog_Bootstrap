<?php
// *********************************************** prepare every odd Comment *****************************************************
    function oddComments($ArtID)
    {
?>
            <div class="m-2 w-25 order-1">
    <?php
        ob_start();
        require_once(PATH . "Assets/PHP/Comment.php");
        $commentslist = Comment::getArticleComments($ArtID);
        $i = 0;
        foreach ($commentslist as $comment)
        {
            if ($i % 2 != 0)
            {
    ?>
            <div class="m-2 card">
                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-wrap">
                        <?=addslashes($comment->Comment)?>

                        </p>
                        <h6 class="card-subtitle mb-2 text-muted"><?=$comment->CommentDate?></h6>
                        <button type="button" class="btn btn-outline-primary m-2 w-50" onclick="editComment(<?=$comment->ID?>, '<?=addslashes($comment->Comment)?>')">Edit</button>
                        <button type="button" class="btn btn-outline-danger m-2 w-50" onclick="deleteComment(<?=$comment->ID?>)">Delete</button>
                    </div>
                </div>
    <?php
            }
        $i++;
        }
    ?>
        </div>
<?php
    return(ob_get_clean());
    }
?>

<?php
//  ******************************************************** prepare every even Comment ***********************************
    function evenComments($ArtID)
    {
?>
            <div class="m-2 w-25 order-3">
    <?php
        ob_start();
        $commentslist = Comment::getArticleComments($ArtID);
        $i = 0;
        foreach ($commentslist as $comment)
        {
            if ($i % 2 == 0)
            {
    ?>
            <div class="card m-2">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <p class="card-text">
                            <?=$comment->Comment?>
                
                        </p>
                        <h6 class="card-subtitle mb-2 text-muted"><?=$comment->CommentDate?></h6>
                        <button type="button" class="btn btn-outline-primary m-2 w-50" onclick="editComment(<?=$comment->ID?>, '<?=addslashes($comment->Comment)?>')">Edit</button>
                        <button type="button" class="btn btn-outline-danger m-2 w-50" onclick="deleteComment(<?=$comment->ID?>)">Delete</button>
                    </div>
                </div>
    <?php
            }
            $i++;
        }
    ?>
        </div>
<?php
    return(ob_get_clean());
    }
//              ********************************************* Write odd comments *******************************************************
    function readOddComments($ArtID)
    {
        echo oddComments($ArtID);
    }

//              ********************************************* Write even comments *******************************************************
    function readEvenComments($ArtID)
    {
        echo evenComments($ArtID);
    }
?>


