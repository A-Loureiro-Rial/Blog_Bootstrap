<?php
    require('../Config.php');

    function addArticle($PDO, $Content, $ArtID)
    {
        $stmt = $PDO->prepare('INSERT INTO Comments (IDArticle, Comment) VALUES(:IDArticle, :Comment);');
        $stmt->bindParam(':IDArticle', $ArtID, PDO::PARAM_INT);
        $stmt->bindParam(':Comment', $Content, PDO::PARAM_STR);
        $stmt->execute();
    }

    function updateArticle($PDO, $Content, $ID)
    {
        $date = date("Y-m-d H:i:s");
        $stmt = $PDO->prepare('UPDATE Comments SET Comment=:Comment, CommentDate=:UpdateDate WHERE ID=:CommentID;');
        $stmt->bindParam(':UpdateDate', $date, PDO::PARAM_STR);
        $stmt->bindParam(':Comment', $Content, PDO::PARAM_STR);
        $stmt->bindParam(':CommentID', $ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    function deleteArticle($PDO, $ID)
    {
        $stmt = $PDO->prepare('DELETE FROM Articles WHERE ID=:ArticleID;');
        $stmt->bindParam(':ArticleID', $ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    $db = 'mysql:host=localhost;dbname=Blog';
    $db_usname = "Stagiaire1";
    $db_keypass = "stagiaire";
    $pdo = new PDO($db, $db_usname, $db_keypass);
    switch ($_POST['mode'])
    {
        case 'add':
        {
            break;
        }
        case 'edit':
        {
            break;
        }
        case 'delete':
        {   
            deleteArticle($pdo, $_POST['ID']);
            break;
        }
    }