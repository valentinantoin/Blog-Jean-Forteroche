<?php

namespace App\Models;

use Config\DbConnection;


/**
 * Class ChapterManager
 * @package App\Models
 */
class ChapterManager extends DbConnection
{
    /**
     * @param $title
     * @param $content
     * @return bool
     */
    public function addChapter($title, $content)
    {
        $req = $this->pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $newChapter = $req->execute(array($title, $content));

        return $newChapter;
    }

//READ CHAPTER

    /**
     * @return mixed
     */
    public function getLastChapter()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');
        $req->execute();
        $lastChapter = $req->fetch();

        return $lastChapter;
    }

    /**
     * @return array
     */
    public function getChapterPage()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');
        $req->execute();
        $chapters = $req->fetchAll();

        return $chapters;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChapter($id)
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE id = ? ');
        $req->execute(array($id));
        $chapter = $req->fetch();

        return $chapter;
    }

//UPDATE CHAPTER

    /**
     * @param $id
     * @param $new_title
     * @param $new_content
     */
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

    /**
     * @param $id
     */
    public function deleteChapter($id)
    {
        $req = $this->pdo->prepare('DELETE FROM chapters WHERE id= ?');
        $req->execute(array($id));
    }

    /**
     * @return mixed
     */
    public function chapterCount()
    {
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbChapter FROM chapters');
        $req->execute(array());
        $nbChapter = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbChapter;
    }
}
