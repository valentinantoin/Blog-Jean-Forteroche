<?php

//CREATE PROTOTYPE
class ChapterManager {



//CREATE CHAPTER
    public function addChapter($title, $content) {

        $pdo = $this->dbConnect();
        $chapter = $pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES(?, ?, NOW())');
        $newChapter = $chapter->execute(array( $title, $content));

        return $newChapter;
    }

//READ CHAPTER
    public function getChapterHome() {

        $pdo = $this->dbConnect();
        $lastChapter = $pdo->query('SELECT title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');

        return $lastChapter;
    }

    public function getChapterPage() {

        $pdo = $this->dbConnect();
        $chapters = $pdo->query('SELECT title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');

        return $chapters;
    }

//UPDATE CHAPTER
    public function updateChapter() {

        $pdo = $this->dbConnect($title, $new_content);
        $req = $pdo->prepare('UPDATE chapters SET content = :new_content, creation_date = NOW() WHERE titlte =:title');
        $req->execute(array('new_content' => $new_content,
                             'title' => $title
                            ));
    }

//DELETE CHAPTER
    public function deleteChapter($title) {
        $pdo = $this->dbConnect();
        $req = $pdo->prepare('DELETE FROM chapters WHERE title= :title');
        $req->execute(array('title' => $title));
    }


//CONNECT TO DB
    private function dbConnect(){

        $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}