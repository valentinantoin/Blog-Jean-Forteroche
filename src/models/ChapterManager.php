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
        $req = $this->pdo->prepare('INSERT INTO chapters(title, content, creation_date, state) VALUES(?, ?, NOW(), "ok")');
        $newChapter = $req->execute(array($title, $content));

        return $newChapter;
    }

    /**
     * @param $title
     * @param $content
     * @return bool
     */
    public function saveChapter($title, $content)
    {
        $req = $this->pdo->prepare('INSERT INTO chapters(title, content, creation_date, state) VALUES(?, ?, NOW(), "hold")');
        $saveChapter = $req->execute(array($title, $content));

        return $saveChapter;
    }

    /**
     * @return mixed
     */
    public function getLastChapter()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters WHERE state = "ok" ORDER BY id DESC LIMIT 1');
        $req->execute();
        $lastChapter = $req->fetch();

        return $lastChapter;
    }

    /**
     * @return array
     */
    public function getChapterPage()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE state = "ok" AND id > 0 ORDER BY id ASC');
        $req->execute();
        $chapters = $req->fetchAll();

        return $chapters;
    }

    /**
     * @return array
     */
    public function getChaptersHold()
    {
        $req = $this->pdo->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters WHERE state = "hold" ORDER BY id ASC');
        $req->execute();
        $chaptersHold = $req->fetchAll();

        return $chaptersHold;
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

    /**
     * @param $id
     * @param $new_title
     * @param $new_content
     */
    public function updateChapter($id, $new_title, $new_content)
    {
        $req = $this->pdo->prepare('UPDATE chapters SET title = :new_title, content = :new_content, creation_date = NOW(), state = "ok" WHERE id =:id');
        $req->execute(array(
            'new_content' => $new_content,
            'new_title' => $new_title,
            'id' => $id
        ));
    }

    /**
     * @param $id
     * @param $new_title
     * @param $new_content
     */
    public function updateChapterHold($id, $new_title, $new_content)
    {
        $req = $this->pdo->prepare('UPDATE chapters SET title = :new_title, content = :new_content, creation_date = NOW(), state = "hold" WHERE id =:id');
        $req->execute(array(
            'new_content' => $new_content,
            'new_title' => $new_title,
            'id' => $id
        ));
    }

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
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbChapter FROM chapters WHERE state = "ok"');
        $req->execute(array());
        $nbChapter = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbChapter;
    }

    /**
     * @return mixed
     */
    public function chapterHoldCount()
    {
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbChapterHold FROM chapters WHERE state = "hold"');
        $req->execute(array());
        $nbChapterHold = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbChapterHold;
    }
}
