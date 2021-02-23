<?php
    require('../Config.php');
    require_once(PATH . 'Assets/PHP/Article.php');
    require_once(PATH . 'Assets/PHP/Category.php');
    $Cat = new Category;
    var_dump($_POST);
    switch ($_POST['mode'])
    {
        case 'add':
        {
            $Cat->CategoryName = $_POST['CategoryTitle'];
            $Cat->CategoryDescription = $_POST['CategoryDescription'];
            $Cat->save();
            break;
        }
        case 'edit':
        {
            $Cat->load($_POST['CategoryID']);
            $Cat->CategoryName = $_POST['CategoryTitle'];
            $Cat->CategoryDescription = $_POST['CategoryDescription'];
            $Cat->update();
            break;
        }
        case 'delete':
        {
            $Cat->delete($_POST['CategoryID']);
            break;
        }
    }