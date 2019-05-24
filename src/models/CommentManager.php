<?php


namespace App\Models;

use Config\DbConnection;

/**
 * Class CommentManager
 * @package App\Models
 */
class CommentManager extends DbConnection
{

    /**
     * @param $chapter_id
     * @param $user_pseudo
     * @param $content
     * @return bool
     */
    public function addComment($chapter_id, $user_pseudo, $content)
    {
        $req = $this->pdo->prepare('INSERT INTO comments (chapter_id, user_pseudo, content, creation_date, report) VALUES( ?, ?, ?, CURRENT_TIME (), "ok")');
        $newComment = $req->execute(array($chapter_id, $user_pseudo, $content));

        return $newComment;
    }

    /**
     * @param $id
     * @return array
     */
    public function getComment($id)
    {
        $req = $this->pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE chapter_id = ' . $id . ' AND report = "ok" ORDER BY creation_date');
        $req->execute();
        $comment = $req->fetchAll();

        return $comment;
    }

    /**
     * @param $new_content
     * @param $id
     * @return bool|\PDOStatement
     */
    public function updateComment($new_content, $id)
    {
        $req = $this->pdo->prepare('UPDATE comments SET content ='.$new_content.', creation_date = NOW() WHERE id ='.$id.' ');
        $req->execute(array($new_content, $id));

        return $req;
    }

    /**
     * @param $id
     */
    public function deleteComment($id)
    {
        $req = $this->pdo->prepare('DELETE FROM comments WHERE id= ?');
        $req->execute(array($id));
    }

    /**
     * @param $id
     */
    public function deleteComments($id)
    {
        $req = $this->pdo->prepare('DELETE FROM comments WHERE chapter_id= ?');
        $req->execute(array($id));
    }

    /**
     * @param $comment_id
     */
    public function setReportComment($comment_id)
    {
        $req = $this->pdo->prepare('UPDATE comments SET report = "pb" WHERE id =?');
        $req->execute(array($comment_id));
    }

    /**
     * @return array
     */
    public function listReportComments()
    {
        $req = $this->pdo->prepare('SELECT id, user_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i \') AS creation_date_fr FROM comments WHERE report = "pb" ' );
        $req->execute();
        $commentList = $req->fetchAll();

        return $commentList;
    }

    /**
     * @param $id
     */
    public function noReportComment($id)
    {
        $req = $this->pdo->prepare('UPDATE comments SET report = "ok" WHERE id =?');
        $req->execute(array($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function commentChapter($id)
    {
        $req = $this->pdo->prepare('SELECT chapter_id FROM comments WHERE id=?' );
        $req->execute(array($id));
        $chapterId = $req->fetch();

        return $chapterId;
    }

    /**
     * @return mixed
     */
    public function commentCount()
    {
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbComment FROM comments');
        $req->execute(array());
        $nbComment = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbComment;
    }

    /**
     * @return mixed
     */
    public function commentPbCount()
    {
        $req = $this->pdo->prepare('SELECT COUNT(*) AS nbCommentPb FROM comments WHERE report = "pb"');
        $req->execute(array());
        $nbCommentPB = $req->fetch(\PDO::FETCH_ASSOC);

        return $nbCommentPB;
    }
}
