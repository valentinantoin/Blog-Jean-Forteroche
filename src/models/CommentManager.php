<?php


namespace App\models;

use config\DbConnection;

//CREATE PROTOTYPE
class CommentManager {

    //CREATE COMMENT
    public function addComment($chapter_id, $user_pseudo, $content)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $comment = $pdo->prepare('INSERT INTO comments (chapter_id, user_pseudo, content, creation_date) VALUES(?, ?, ?, NOW())');
        $newComment = $comment->execute(array($chapter_id, $user_pseudo, $content));

        return $newComment;
    }

    //READ COMMENT
    public function getComment($id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $comment = $pdo->query('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%mm \') AS creation_date_fr FROM comments WHERE chapter_id = ' . $id . ' ');

        return $comment;
    }

    //UPDATE COMMENT
    public function updateComment($new_content, $id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('UPDATE comments SET content ='.$new_content.', creation_date = NOW() WHERE id ='.$id.'');
        $req->execute(array($new_content, $id));
    }

    //DELETE COMMENT
    public function deleteComment($id)
    {
        $dbConnection = new DbConnection();
        $pdo = $dbConnection->dbConnect();
        $req = $pdo->prepare('DELETE FROM comments WHERE id='.$id.'');
        $req->execute(array($id));
    }
}
