<?php

use App\Controllers\Controller;
use App\models\ChapterManager;
use App\models\CommentManager;


class ChapterController extends Controller {


    public function chapterList() {

        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapterPage();

        echo $this->render("chapters.twig",['chapters' => $chapters]);
    }

    public function chapterRead() {

        $id = $_GET['id'];
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);
        $commentManager = new CommentManager();
        $comments = $commentManager->getComment($id);

        echo $this->render("chapter.twig",['chapter' => $chapter, 'comments' => $comments]);
    }

    public function chapterLast() {

        $chapterManager = new ChapterManager();
        $chapterLast = $chapterManager->getLastChapter();

        echo $this->render("home.twig",['chapter' => $chapterLast]);
    }

    public function chapterAdd() {

        $title = $_POST['title'];
        $content = $_POST['content'];

        $chapterManager = new ChapterManager();
        $chapterManager->addChapter($title, $content);
        $chapterLast =$chapterManager->getLastChapter();

        echo $this->render("home.twig",['chapter' => $chapterLast]);
    }
}
