<?php

use App\Controllers\Controller;
use App\Models\CommentManager;
use App\Models\ChapterManager;

class CommentController extends Controller {


    public function commentList() {

        $id = $_GET['id'];
        $commentManager = new CommentManager();
        $comments = $commentManager->getComment($id);

        echo $this->render("chapter.twig",['comments' => $comments]); //FUNCTION CALL IN CHAPTERCONTROLLER !!!

    }

    public function addComment() {

        $id = $_GET['id'];
        $chapter_id = $id;
        $user_pseudo = $_SESSION['pseudo'];
        $content = $_POST['comment'];


        $commentManager = new CommentManager();
        $commentManager->addComment($chapter_id, $user_pseudo, $content);
        $comments = $commentManager->getComment($id);

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);

        echo $this->render("chapter.twig",['chapter' => $chapter, 'comments' => $comments]);

    }

}