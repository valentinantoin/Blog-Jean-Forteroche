<?php

namespace App\models;

use config\DbConnection;

//CREATE PROTOTYPE
class ChapterManager
{

//CREATE CHAPTER
    public function addChapter($title, $content)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $chapter = $pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $newChapter = $chapter->execute(array($title, $content));

        return $newChapter;
    }

//READ CHAPTER
    public function getLastChapter()
    {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $lastChapter = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');


        return $lastChapter;
    }

    public function getChapterPage()
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $chapters = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');

        return $chapters;
    }

    public function getChapter($id)
    {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $chapter = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE id = ' . $id . ' ');

        return $chapter;
    }

//UPDATE CHAPTER
    public function updateChapter($title, $new_content)
    {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('UPDATE chapters SET content = :new_content, creation_date = NOW() WHERE titlte =:title');
        $req->execute(array('new_content' => $new_content,
            'title' => $title
        ));
    }

//DELETE CHAPTER
    public function deleteChapter($title)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('DELETE FROM chapters WHERE title= :title');
        $req->execute(array($title));
    }
}
