<?php


namespace App\models;

//CREATE PROTOTYPE
class ChapterManager
{

//CREATE CHAPTER
    public function addChapter($title, $content)
    {

        $pdo = dbConnect();
        $chapter = $pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $newChapter = $chapter->execute(array($title, $content));

        return $newChapter;
    }

//READ CHAPTER
    public function getLastChapter()
    {

        $pdo = dbConnect();
        $lastChapter = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');


        return $lastChapter;
    }

    public function getChapterPage()
    {
        $pdo = dbConnect();
        $chapters = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');

        return $chapters;
    }

    public function getChapter($id)
    {

        $pdo = dbConnect();
        $chapter = $pdo->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE id = ' . $id . ' ');

        return $chapter;
    }

//UPDATE CHAPTER
    public function updateChapter()
    {

        $pdo = dbConnect($title, $new_content);
        $req = $pdo->prepare('UPDATE chapters SET content = :new_content, creation_date = NOW() WHERE titlte =:title');
        $req->execute(array('new_content' => $new_content,
            'title' => $title
        ));
    }

//DELETE CHAPTER
    public function deleteChapter($title)
    {
        $pdo = dbConnect();
        $req = $pdo->prepare('DELETE FROM chapters WHERE title= :title');
        $req->execute(array('title' => $title));
    }
}
