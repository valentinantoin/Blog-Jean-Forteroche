<?php

use App\models\ChapterManager;
use App\models\CommentManager;

class ChapterController {

    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        // Stores the Twig engine
        $this->twig = $twig;
    }

    public function render( $view, array $params = [])
    {
        // Returns the rendering of the view
        return $this->twig->render($view, $params);
    }


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
        $lastChapter = $chapterManager->getLastChapter();

        echo $this->render("home.twig",['chapters' => $lastChapter]);

    }

    public function chapterAdd() {

        $content = $_POST['content'];
        $title = $_POST['title'];

        $chapterManager = new ChapterManager();
        $addChapter = $chapterManager->addChapter( $title, $content);

        echo $this->render("home.twig",['chapters' => $addChapter]);

    }
}
