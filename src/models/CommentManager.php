<?php


namespace App\Models;

use Config\DbConnection;

//CREATE PROTOTYPE
class CommentManager {

    //CREATE COMMENT
    public function addComment($chapter_id, $user_pseudo, $content)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('INSERT INTO comments (chapter_id, user_pseudo, content, creation_date, report) VALUES( ?, ?, ?, CURRENT_TIME (), "ok")');
        $newComment = $req->execute(array($chapter_id, $user_pseudo, $content));

        return $newComment;
    }

    //READ COMMENT
    public function getComment($id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE chapter_id = ' . $id . ' ORDER BY creation_date');
        $req->execute();
        $comment = $req->fetchAll();

        return $comment;
    }

    //UPDATE COMMENT
    public function updateComment($new_content, $id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('UPDATE comments SET content ='.$new_content.', creation_date = NOW() WHERE id ='.$id.' ');
        $req->execute(array($new_content, $id));

        return $req;
    }

    //DELETE COMMENT
    public function deleteComment($id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('DELETE FROM comments WHERE id='.$id.' ');
        $req->execute(array($id));

        return $req;
    }

    //REPORT COMMENT
    public function setReportComment($id) {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('UPDATE comments SET report = "pb" WHERE id =?');
        $req->execute(array($id));
    }

    //GET REPORTED COMMENTS
    public function listReportComments() {

        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE report = "pb" ' );
        $req->execute();
        $commentList = $req->fetchAll();

        return $commentList;
    }
}
