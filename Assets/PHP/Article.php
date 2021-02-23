<?php
require_once('Category.php');
class Article
{//                                                             ***************** Parameters of an article *****************
    public $ID;//                                               * - ID of the Article                                      *
    public $Title;//                                            * - Its Title                                              *
    public $Author;//                                           * - Its Author                                             *
    public $Content;//                                          * - Its Content                                            *
    public $UpdateDate;//                                       * - Its Creation Date                                      *
    public $CreationDate;//                                     * - The date of Its last update                            *
    public $Views;//                                            * - Its number of views                                    *
    public $CategoryList;//                                     * - Array that contains all the categories related to it   *
    public $CommentList;//                                      * - Array that contains all the comments related to it     * 
//                                                              ************************************************************

//                                                              ********************** DB Parameters ***********************
    private static $db = 'mysql:host=localhost;dbname=Blog';//  * - Host and DB Name                                       *
    private static $db_usname = "Stagiaire1";//                 * - DB Username                                            *
    private static $db_keypass = "stagiaire";//                 * - DB Password                                            *
    private static $pdo;//                                      * - Just so that I don't spam new pdo                      *
//                                                              ************************************************************

//      ********************** Construct function **************************
    public function __construct($Title = null, $Author = null, $Content = null)
    {
        $this->ID = 0;
        $this->Title = $Title;
        $this->Author = $Author;
        $this->Content = $Content;
        $this->Views = 0;
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
    }

//      ******************** function that deletes an article loaded or an article given its ID *******************************
    public function delete($id = null)
    {
        $stmt = self::$pdo->prepare('DELETE FROM Articles WHERE ID=:id;');
        if ($id === null)
        {
            $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
            $this->ID = 0;
            $this->Title = null;
            $this->Author = null;
            $this->Content = null;
            $this->Views = 0;
            $this->CommentList = [];
        }
        else
        {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

//      ********************** Method that update an article in DB ***************************
    public function update()
    {
        $this->UpdateDate = date("Y-m-d H:i:s");
        $stmt = self::$pdo->prepare('UPDATE Articles SET Title=:ArticleTitle, Author=:AuthorName, Content=:Article, UpdateDate=:UpdateDate WHERE ID=:ArticleID;');
        $stmt->bindParam(':Article', $this->Content, PDO::PARAM_STR);
        $stmt->bindParam(':ArticleTitle', $this->Title, PDO::PARAM_STR);
        $stmt->bindParam(':AuthorName', $this->Author, PDO::PARAM_STR);
        $stmt->bindParam(':UpdateDate', $this->UpdateDate);
        $stmt->bindParam(':ArticleID', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
    }

//      ********************** Method that save in DB a new Article ***************************
    public function save()
    {
        if (isset($this->Title) && isset($this->Author) && isset($this->Content))
        {
            $stmt = self::$pdo->prepare('INSERT INTO Articles (Title, Author, Content, Views) VALUES (:title, :author, :content, 0);');
            $stmt->bindParam(':title', $this->Title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $this->Author, PDO::PARAM_STR);
            $stmt->bindParam(':content', $this->Content, PDO::PARAM_STR);
            $stmt->execute();
            $this->ID = self::$pdo->lastInsertId();
        }
    }

//      ********************** Method that insert in the DB a new Article ***************************
    public function getComments()
    {
        $stmt = self::$pdo->prepare('SELECT * FROM Comments WHERE IDArticle=:Article ORDER BY CommentDate DESC;');
        $stmt->bindParam(':Article', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
        $this->CommentList = $stmt->Fetchall(PDO::FETCH_ASSOC);
    }

//      ********************** Function that loads an article given its ID ***************************
    public function load($id)
    {
        $stmt = self::$pdo->prepare('SELECT * FROM Articles WHERE ID=:id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->Fetch(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value)
        {
            $this->$key = $value;
        }
        $this->Views = intval($this->Views);
    }

    //      *************** Method that get from the DB all categories related to the loaded article ********************
    public function getRelatedCategories()
    {
        $stmt = self::$pdo->prepare('SELECT CategoryID FROM Categories AS c INNER JOIN CateArtiLink as l ON c.CategoryID=l.CatID INNER JOIN Articles AS a ON a.ID=l.ArtID AND l.ArtID=:id;');
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
        $CatList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->CategoryList = [];
        foreach ($CatList as $Category)
        {
            $this->CategoryList[] = new Category;
            $this->CategoryList[count($this->CategoryList) - 1]->load($Category['CategoryID']);
        }
    }
    
    //      ************ Function that adds a Category to the loaded Article given its ID *******************
    public function addCategory($id)
    {
        $stmt = self::$pdo->prepare('INSERT INTO CateArtiLink (CatID, ArtID) VALUES (:CID, :AID);');
        $stmt->bindParam(':CID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':AID', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
        $this->getRelatedCategories();
    }

//      *********** Function that removes a Category from the loaded Article given its ID *******************
    public function removeCategory($id)
    {
        $stmt = self::$pdo->prepare('DELETE FROM CateArtiLink WHERE CatID=:CID AND ArtID=:AID;');
        $stmt->bindParam(':CID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':AID', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
        $this->getRelatedCategories();
    }

//      ***************************** Method that add a view to the loaded Article in DB ***********************************
    public function addView()
    {
        $this->Views++;
        $stmt = self::$pdo->prepare('UPDATE Articles SET Views=:views WHERE ID=:ArticleID;');
        $stmt->bindParam(':views', $this->Views, PDO::PARAM_INT);
        $stmt->bindParam(':ArticleID', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
    }

//      *********** Method that returns an array of Article objects for each article in DB ******************
    public static function ExportAll()
    {
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
        $stmt = self::$pdo->prepare('SELECT ID FROM Articles');
        $stmt->execute();
        $IDList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Articles = [];
        foreach ($IDList as $ID)
        {
            $Articles[] = new Article;
            $Articles[count($Articles) - 1]->load($ID['ID']);
        }
        return ($Articles);
    }

//      ******************** Method that returns an array with the 3 articles with the most views **********************
    public static function ExportPopular()
    {
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
        $stmt = self::$pdo->prepare('SELECT ID FROM Articles ORDER BY Views DESC LIMIT 3;');
        $stmt->execute();
        $Articles = [];
        $IDList = $stmt->Fetchall(PDO::FETCH_ASSOC);
        foreach ($IDList as $ID)
        {
            $Articles[] = new Article;
            $Articles[count($Articles) - 1]->load($ID['ID']);
        }
        return ($Articles);
    }
}// **** END OF CLASS ****