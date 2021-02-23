<?php
require('../Config.php');
require_once(PATH . 'Assets/PHP/Comment.php');
function addComment($Content, $ArtID)
{
    $Comment = new Comment($ArtID, $Content);
    $Comment->save();
}

function updateComment($Content, $ID)
{
    $Comment = new Comment;
    $Comment->load($ID);
    $Comment->Comment = $Content;
    $Comment->update();
}

function deleteComment($ID)
{
    $Comment = new Comment;
    $Comment->delete($ID);
}

switch ($_POST['mode'])
{
    case 'add':
    {
        addComment($_POST['comment'], $_POST['ArtID']);
        break;
    }
    case 'edit':
    {
        echo 'EDIT';
        updateComment($_POST['comment'], $_POST['commentID']);
        break;
    }
    case 'delete':
    {   
        deleteComment($_POST['commentID']);
        break;
    }
}