<?php
    function isChecked($article, $Cat):bool
    {
        foreach ($article->CategoryList as $Catrow)
        {
            if (strcmp($Catrow->CategoryName, $Cat->CategoryName) === 0)
            {
                return true;
            }
        }
        return false;
    }

    function isNeeded($article, $CatID):bool
    {
        foreach ($article->CategoryList as $Catrow)
        {
            if (strcmp($Catrow->CategoryID, $CatID) === 0)
            {
                return false;
            }
        }
        return true;
    }