<?php
require_once('Article.php');
class Category
{//                                                             *********** Parameters of a category ***********
    public $CategoryID;//                                       * - ID of the category                         *
    public $CategoryName;//                                     * - Its name                                   *
    public $CategoryDescription;//                              * - Its description                            *
    public $ArticleList;//                                      * - Array of articles related to this category *
//                                                              ************************************************

//                                                              **************** DB Parameters *****************
    private static $db = 'mysql:host=localhost;dbname=Blog';//  * - Host and DB Name                           *
    private static $db_usname = "Stagiaire1";//                 * - DB Username                                *
    private static $db_keypass = "stagiaire";//                 * - DB Password                                *
    private static $pdo;//                                      * - Just so that I don't spam new pdo          *
//                                                              ************************************************

//      *************** Constructor function ****************
    public function __construct($CatName = null, $CatDes = null)
    {
        $this->CategoryID = 0;
        $this->CategoryName = $CatName;
        $this->CategoryDescription = $CatDes;
        $this->ArticleList = [];
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
    }

//      ****************** Function that loads a Category ******************
    public function load($CatID)
    {
        $stmt = self::$pdo->prepare('SELECT * FROM Categories WHERE CategoryID=:id;');
        $stmt->bindParam(':id', $CatID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->Fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value)
        {
            $this->$key = $value;
        }
    }
//      ********************** Method that updates a Category in DB ***************************
    public function update()
    {
        $stmt = self::$pdo->prepare('UPDATE Categories SET CategoryName=:CatName, CategoryDescription=:CatDes WHERE CategoryID=:CatID;');
        $stmt->bindParam(':CatName', $this->CategoryName, PDO::PARAM_STR);
        $stmt->bindParam(':CatDes', $this->CategoryDescription, PDO::PARAM_STR);
        $stmt->bindParam(':CatID', $this->CategoryID, PDO::PARAM_INT);
        $stmt->execute();
    }

//      ********************** Method that save in DB a new Category ***************************
    public function save()
    {
        if (isset($this->CategoryName) && isset($this->CategoryDescription))
        {
            $stmt = self::$pdo->prepare('INSERT INTO Categories (CategoryName, CategoryDescription) VALUES (:CatName, :CatDes);');
            $stmt->bindParam(':CatName', $this->CategoryName, PDO::PARAM_STR);
            $stmt->bindParam(':CatDes', $this->CategoryDescription, PDO::PARAM_STR);
            $stmt->execute();
            $this->CategoryID = self::$pdo->lastInsertId();
        }
    }

//      ******************** Method that deletes a Category loaded or a Category given its ID *******************************
public function delete($id = null)
{
    $stmt = self::$pdo->prepare('DELETE FROM Categories WHERE CategoryID=:id;');
    if ($id === null)
    {
        $stmt->bindParam(':id', $this->CategoryID, PDO::PARAM_INT);
    }
    else
    {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    $stmt->execute();
    $this->CategoryID = 0;
    $this->CategoryName = null;
    $this->CategoryDescription = null;
    $this->ArticleList = [];
}

//      *************** Function that get from the DB all articles related to the category loaded ********************
    public function getRelatedArticles()
    {
        $stmt = self::$pdo->prepare('SELECT ID FROM Articles AS a INNER JOIN CateArtiLink as l ON a.ID=l.ArtID INNER JOIN Categories AS c ON c.CategoryID=l.CatID AND l.CatID=:id;');
        $stmt->bindParam(':id', $this->CategoryID, PDO::PARAM_INT);
        $stmt->execute();
        $ArticleList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->ArticleList = [];
        foreach ($ArticleList as $Article)
        {
            $this->ArticleList[] = new Article();
            $this->ArticleList[count($this->ArticleList) - 1]->load($Article['ID']);
        }
    }

//      ************ Add an Article to the loaded category given its ID
    public function addArticle($id)
    {
        $stmt = self::$pdo->prepare('INSERT INTO CateArtiLink (CatID, ArtID) VALUES (:CID, :AID);');
        $stmt->bindParam(':CID', $this->CategoryID, PDO::PARAM_INT);
        $stmt->bindParam(':AID', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->getRelatedArticles();
    }

//      *********** remove an Article from the loaded category given its ID *************************
    public function removeArticle($id)
    {
        $stmt = self::$pdo->prepare('DELETE FROM CateArtiLink WHERE CatID=:CID AND ArtID=:AID;');
        $stmt->bindParam(':CID', $this->CategoryID, PDO::PARAM_INT);
        $stmt->bindParam(':AID', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->getRelatedArticles();
    }

//      *********** method taht return an array with every category loaded in objects ************************
    public static function ExportAll()
    {
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
        $stmt = self::$pdo->prepare('SELECT CategoryID FROM Categories');
        $stmt->execute();
        $IDList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Categories = [];
        foreach ($IDList as $ID)
        {
            $Categories[] = new Category;
            $Categories[count($Categories) - 1]->load($ID['CategoryID']);
        }
        return ($Categories);
    }
}// **** END OF CLASS ****