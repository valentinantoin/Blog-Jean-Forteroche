<?php

use App\Controllers\Controller;
use App\Models\ChapterManager;
use App\Models\CommentManager;

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

        echo "<script>alert(\"Ce chapitre a bien été ajouté.\")</script>";

        $chapterLast =$chapterManager->getLastChapter();

        echo $this->render("home.twig",['chapter' => $chapterLast]);
    }

    public function chapterDelete() {

        $id = $_GET['id'];

        $chapterManager = new ChapterManager();
        $chapterManager->deleteChapter($id);
        $commentManager = new CommentManager();
        $commentManager->deleteComments($id);

        echo "<script>alert(\"Ce chapitre a bien été supprimé.\")</script>";

        $chapters = $chapterManager->getChapterPage();

        echo $this->render("chapters.twig",['chapters' => $chapters]);
    }

    public function chapterModify() {

        $id = $_GET['id'];

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);

        echo $this->render("modify.twig",['chapter' => $chapter]);
    }

    public function updateChapter() {

        $id = $_GET['id'];
        $new_title = $_POST['title'];
        $new_content = $_POST['content'];

        $chapterManager = new ChapterManager();
        $chapterManager->updateChapter($id, $new_title, $new_content);
        $chapter = $chapterManager->getChapter($id);

        echo $this->render('chapter.twig', ['chapter' => $chapter]);




    }
}
