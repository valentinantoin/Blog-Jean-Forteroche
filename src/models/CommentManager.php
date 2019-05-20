<?php


namespace App\Models;

use Config\DbConnection;

//CREATE PROTOTYPE
class CommentManager extends DbConnection
{

    //CREATE COMMENT
    public function addComment($chapter_id, $user_pseudo, $content)
    {
        $req = $this->pdo->prepare('INSERT INTO comments (chapter_id, user_pseudo, content, creation_date, report) VALUES( ?, ?, ?, CURRENT_TIME (), "ok")');
        $newComment = $req->execute(array($chapter_id, $user_pseudo, $content));

        return $newComment;
    }

    //READ COMMENT
    public function getComment($id)
    {
        $req = $this->pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE chapter_id = ' . $id . ' AND report = "ok" ORDER BY creation_date');
        $req->execute();
        $comment = $req->fetchAll();

        return $comment;
    }

    //UPDATE COMMENT
    public function updateComment($new_content, $id)
    {
        $req = $this->pdo->prepare('UPDATE comments SET content ='.$new_content.', creation_date = NOW() WHERE id ='.$id.' ');
        $req->execute(array($new_content, $id));

        return $req;
    }

    //DELETE COMMENT
    public function deleteComment($id)
    {
        $req = $this->pdo->prepare('DELETE FROM comments WHERE id= ?');
        $req->execute(array($id));
    }

    //DELETE COMMENTS FROM CHAPTER DELETE
    public function deleteComments($id) {

        $req = $this->pdo->prepare('DELETE FROM comments WHERE chapter_id= ?');
        $req->execute(array($id));
    }

    //REPORT COMMENT
    public function setReportComment($comment_id) {

        $req = $this->pdo->prepare('UPDATE comments SET report = "pb" WHERE id =?');
        $req->execute(array($comment_id));
    }

    //GET REPORTED COMMENTS
    public function listReportComments() {

        $req = $this->pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE report = "pb" ' );
        $req->execute();
        $commentList = $req->fetchAll();

        return $commentList;
    }

    //DE REPORT COMMENT
    public function noReportComment($id) {

        $req = $this->pdo->prepare('UPDATE comments SET report = "ok" WHERE id =?');
        $req->execute(array($id));
    }

    //GET CHAPTER_ID FROM COMMENT
    public function commentChapter($id) {

        $req = $this->pdo->prepare('SELECT chapter_id FROM comments WHERE id=?' );
        $req->execute(array($id));
        $chapterId = $req->fetch();

        return $chapterId;
    }

    //GET NUMBER OF COMMENT
    public function commentCount() {

        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbComment FROM comments');
        $req->execute(array());
        $nbComment = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbComment;
    }
}
