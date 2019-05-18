<?php

namespace App\Models;

use Config\DbConnection;


class ChapterManager extends DbConnection
{

//CREATE CHAPTER
    public function addChapter($title, $content)
    {
        $req = $this->pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $newChapter = $req->execute(array($title, $content));

        return $newChapter;
    }

//READ CHAPTER
    public function getLastChapter()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');
        $req->execute();
        $lastChapter = $req->fetch();

        return $lastChapter;
    }

    public function getChapterPage()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');
        $req->execute();
        $chapters = $req->fetchAll();

        return $chapters;
    }

    public function getChapter($id)
    {

        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE id = ? ');
        $req->execute(array($id));
        $chapter = $req->fetch();
        return $chapter;
    }

//UPDATE CHAPTER
    public function updateChapter($id, $new_title, $new_content)
    {

        $req = $this->pdo->prepare('UPDATE chapters SET title = :new_title, content = :new_content, creation_date = NOW() WHERE id =:id');
        $req->execute(array(
            'new_content' => $new_content,
            'new_title' => $new_title,
            'id' => $id
        ));
    }

//DELETE CHAPTER
    public function deleteChapter($id)
    {
        $req = $this->pdo->prepare('DELETE FROM chapters WHERE id= ?');
        $req->execute(array($id));
    }
}
