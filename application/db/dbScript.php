<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ImageDb 
{
    public static function createDb($dbname)
    {
        $pdo = new PDO('sqlite:' . $dbname);
        
        $pdo->exec('CREATE  TABLE "photos" 
                (   "id" INTEGER PRIMARY KEY NOT NULL , 
                    "title" TEXT NOT NULL  UNIQUE , 
                    "original_filename" TEXT NOT NULL  UNIQUE , 
                    "thumb_filename" TEXT NOT NULL  UNIQUE 
                )');
        $pdo = null;
    }
}
?>
