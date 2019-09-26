<?php

namespace App\Controllers;

use App\Models\ChapterManager;
use App\Models\CommentManager;


/**
 * Class ChapterController
 */
class ChapterController extends Controller {

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterList()
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapterPage();

        echo $this->render("chapters.twig",['chapters' => $chapters]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterRead()
    {
        $id = filter_input(INPUT_GET,'id');
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);
        $commentManager = new CommentManager();
        $comments = $commentManager->getComment($id);

        if ($id == 1){

            echo $this->render('presentation.twig', ['presentation' => $chapter]);
        }else

        echo $this->render("chapter.twig",['chapter' => $chapter, 'comments' => $comments]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterLast()
    {
        $chapterManager = new ChapterManager();
        $chapterLast = $chapterManager->getLastChapter();

        echo $this->render("home.twig",['chapter' => $chapterLast]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterAdd()
    {
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');

        $chapterManager = new ChapterManager();
        $chapterManager->addChapter($title, $content);

        echo "<script>alert(\"Ce chapitre a bien été ajouté.\")</script>";

        $chapters = $chapterManager->getChapterPage();

        echo $this->render("chapters.twig",['chapters' => $chapters]);
    }


    /**
     *
     */
    public function chapterSave()
    {
        $title = filter_input(INPUT_POST, 'title');
        $content = filter_input(INPUT_POST, 'content');

        $chapterManager = new ChapterManager();
        $chapterManager->saveChapter($title, $content);

        echo "<script>alert(\"Ce chapitre a bien été sauvegardé.\")</script>";

        echo "<script>window.location = '../index.php?access=admin'</script>";
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterDelete()
    {
        $id = filter_input(INPUT_GET,'id');

        $chapterManager = new ChapterManager();
        $chapterManager->deleteChapter($id);
        $commentManager = new CommentManager();
        $commentManager->deleteComments($id);

        echo "<script>alert(\"Ce chapitre a bien été supprimé.\")</script>";

        $chapters = $chapterManager->getChapterPage();

        echo $this->render("chapters.twig",['chapters' => $chapters]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function chapterModify()
    {
        $id = filter_input(INPUT_GET,'id');

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);

        echo $this->render("modify.twig",['chapter' => $chapter]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function updateChapter()
    {
        $id = filter_input(INPUT_GET,'id');
        $new_title = filter_input(INPUT_POST, 'title');
        $new_content = filter_input(INPUT_POST, 'content');

        $chapterManager = new ChapterManager();
        $chapterManager->updateChapter($id, $new_title, $new_content);
        $chapter = $chapterManager->getChapter($id);

        if ($id == 1){

            echo $this->render('presentation.twig', ['presentation' => $chapter]);
        }else

            echo $this->render("chapter.twig",['chapter' => $chapter]);
    }


    /**
     *
     */
    public function updateChapHold() {

        $id = filter_input(INPUT_GET,'id');
        $new_title = filter_input(INPUT_POST, 'title');
        $new_content = filter_input(INPUT_POST, 'content');

        $chapterManager = new ChapterManager();
        $chapterManager->updateChapterHold($id, $new_title, $new_content);

        header('Location: ../index.php?acces=admin');
    }
}
