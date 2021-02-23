<?php
    class Comment
    {
        public $ID;
        public $IDArticle;
        public $Comment;
        public $CommentDate;
    //                                                              ********************** DB Parameters ***********************
        private static $db = 'mysql:host=localhost;dbname=Blog';//  * - Host and DB Name                                       *
        private static $db_usname = "Stagiaire1";//                 * - DB Username                                            *
        private static $db_keypass = "stagiaire";//                 * - DB Password                                            *
        private static $pdo;//                                      * - Just so that I don't spam new pdo                      *
    //                                                              ************************************************************


//      ********************** Construct function **************************
    public function __construct($IDArticle = null, $Comment = null)
    {
        $this->ID = 0;
        $this->IDArticle = $IDArticle;
        $this->Comment = $Comment;
        self::$pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
    }

//      ******************** function that deletes an article loaded or an article given its ID *******************************
    public function delete($id = null)
    {
        $stmt = self::$pdo->prepare('DELETE FROM Comments WHERE ID=:id;');
        if ($id === null)
        {
            $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);
            $this->ID = NULL;
            $this->IDArticle = NULL;
            $this->Comment = NULL;
            $this->CommentDate = NULL;
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
        $this->CommentDate = date("Y-m-d H:i:s");
        $stmt = self::$pdo->prepare('UPDATE Comments SET IDArticle=:IDArticle, Comment=:Comment, CommentDate=:CommentDate WHERE ID=:ID;');
        $stmt->bindParam(':IDArticle', $this->IDArticle, PDO::PARAM_INT);
        $stmt->bindParam(':Comment', $this->Comment, PDO::PARAM_STR);
        $stmt->bindParam(':CommentDate', $this->CommentDate);
        $stmt->bindParam(':ID', $this->ID, PDO::PARAM_INT);
        $stmt->execute();
    }

//      ********************** Function that loads an article given its ID ***************************
public function load($id)
{
    $stmt = self::$pdo->prepare('SELECT * FROM Comments WHERE ID=:id;');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->Fetch(PDO::FETCH_ASSOC);
    foreach ($result as $key => $value)
    {
        $this->$key = $value;
    }
}

//      ********************** Method that save in DB a new Article ***************************
    public function save()
    {
        if (isset($this->IDArticle) && isset($this->Comment))
        {
            $stmt = self::$pdo->prepare('INSERT INTO Comments (IDArticle, Comment) VALUES (:IDArticle, :Comment);');
            $stmt->bindParam(':IDArticle', $this->IDArticle, PDO::PARAM_INT);
            $stmt->bindParam(':Comment', $this->Comment, PDO::PARAM_STR);
            $stmt->execute();
            $this->load(self::$pdo->lastInsertId());
        }
    }

//      ********************** Method that insert in the DB a new Article ***************************
    public static function getArticleComments($ArtID)
    {
        $pdo = new PDO(self::$db, self::$db_usname, self::$db_keypass);
        $stmt = $pdo->prepare('SELECT ID FROM Comments WHERE IDArticle=:Article ORDER BY CommentDate DESC;');
        $stmt->bindParam(':Article', $ArtID, PDO::PARAM_INT);
        $stmt->execute();
        $Tmp = $stmt->Fetchall(PDO::FETCH_ASSOC);
        $CommentList = [];
        foreach ($Tmp as $Comment)
        {
            $CommentList[] = new Comment;
            $CommentList[count($CommentList) - 1]->load($Comment['ID']);
        }
        return ($CommentList);
    }
}//END OF CLASS
