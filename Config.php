<?php

//Database parameters
$DbMs = 'mysql';//              Database management system
$DbHost = 'localhost'; //       Database Host
$DbName = 'Blog';//                 Database Name
$DbUser = 'Stagiaire1';//       Database Username
$DbPassword = 'stagiaire';//    Database User Password

//Paths parameters
$SerPath = '/var/www/html/simple-blog/2.0/';
$ClientPath = 'http://'. $_SERVER['SERVER_NAME'] . '/simple-blog/2.0/';

//Defining DB constants
define('DBMS', $DbMs);
define('DBHOST', $DbHost);
define('DBNAME', $DbName);
define('DBUSER', $DbUser);
define('DBPASSWORD', $DbPassword);

//Defining Path constants
define('PATH', $SerPath);
define('HTMLPATH', $ClientPath);

//CSS Links Parameters
$CSS = array(
    "Index" => array(
    )
);

//Defining CSS Links array constant
define('CSSLINKS', $CSS);

//JS Links Parameters
$JS = array(
    "HomePage" => array(
    ),
    "Read" => array(
        "JQuery" => 'Assets/JS/JQuery.js',
        "Comments management" => 'Assets/JS/Comments.js',
        "Article management" => 'Assets/JS/Article.js'
    ),
    "Articles" => array(
        
    ),
    "Success" => array(
        "JQuery" => 'Assets/JS/JQuery.js',
        "Timer" => 'Assets/JS/Timer.js'
    ),
    "Modified" => array(
        "JQuery" => 'Assets/JS/JQuery.js',
        "Timer" => 'Assets/JS/Timer.js'
    ),
    "Categories" => array(
        "JQuery" => 'Assets/JS/JQuery.js',
        "Category management" => 'Assets/JS/Category.js'
    ),
    "Category" => array(
        "JQuery" => 'Assets/JS/JQuery.js',
        "Category management" => 'Assets/JS/Category.js'
    ),
    "Contact" => array(
        
    )
);

//Defining CSS Links array constant
define('JSLINKS', $JS);

class page
{
    public $title;
    public $content;
    public $favicon;

    public function __construct($title = null, $favicon = null, $content = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->favicon = $favicon;
    }

    public function getPage($Page)
    {
        require_once(PATH . 'functions/getContent.php');
        require_once(PATH . "Templates/Header.php");
        ob_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <title><?=$this->title?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
<?php
    echo getHeader();
    getContent($Page);
    require_once(PATH . 'functions/getScript.php');
?>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
        echo getScripts(JSLINKS[$Page]);
?>
    </body>
</html>
<?php
    $this->content = ob_get_clean();
    }

    public function printPage()
    {
        echo $this->content;
    }
}