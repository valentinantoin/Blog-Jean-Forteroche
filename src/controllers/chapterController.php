<?php

require_once ("../src/models/ChapterManager.php");
require_once ('../config/dbConnection.php');


class ChapterController {


    public function chapterList() {

        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapterPage();

        echo $twig->render("chapters.twig",['chapters' => $chapters]);

    }

    public function chapterRead() {

        $id = $_GET['id'];
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);

        echo $twig->render("chapter.twig",['chapter' => $chapter]);

    }

    public function chapterLast() {

        $chapterManager = new ChapterManager();
        $lastChapter = $chapterManager->getLastChapter();

        echo $twig->render("home.twig",['chapters' => $lastChapter]);

    }

    public function chapterAdd() {


        $content = $_POST['content'];
        $title = $_POST['title'];

        $chapterManager = new ChapterManager();
        $addChapter = $chapterManager->addChapter( $title, $content);

        echo $twig->render("home.twig",['chapters' => $addChapter]);

    }
}
