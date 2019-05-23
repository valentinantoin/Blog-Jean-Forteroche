<?php


use App\Controllers\Controller;
use App\Models\CommentManager;
use App\Models\ChapterManager;
use App\Models\UserManager;


/**
 * Class CommentController
 */
class CommentController extends Controller
{

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function commentList()
    {
        $id = $_GET['id'];
        $commentManager = new CommentManager();
        $comments = $commentManager->getComment($id);

        echo $this->render("chapter.twig", ['comments' => $comments]); //FUNCTION CALL IN CHAPTERCONTROLLER !!!
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function addComment()
    {
        $id = $_GET['id'];
        $chapter_id = $id;
        $user_pseudo = $_SESSION['pseudo'];
        $content = $_POST['comment'];

        $commentManager = new CommentManager();
        $commentManager->addComment($chapter_id, $user_pseudo, $content);
        $comments = $commentManager->getComment($id);

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);

        echo $this->render("chapter.twig", ['chapter' => $chapter, 'comments' => $comments]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function reportComment()
    {
        $id = $_GET['id'];
        $comment_id = $_GET['com'];

        $commentManager = new CommentManager();
        $commentManager->setReportComment($comment_id);

        echo "<script>alert(\"Ce commentaire a bien été signalé.\")</script>";

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($id);
        $comments = $commentManager->getComment($id);

        echo $this->render("chapter.twig", ['chapter' => $chapter, 'comments' => $comments]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function deleteComment()
    {
        $id = $_GET['id'];

        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);
        $commentsList = $commentManager->listReportComments();
        $nbComment = $commentManager->commentCount();
        $chapterManager = new ChapterManager();
        $nbChapter = $chapterManager->chapterCount();
        $chaptersHold = $chapterManager->getChaptersHold();
        $userManager = new UserManager();
        $nbUser = $userManager->userCount();

        echo $this->render("admin.twig",
            ['comments' => $commentsList,
                'nbChapter' => $nbChapter['nbChapter'],
                'nbComment' => $nbComment['nbComment'],
                'chaptersHold' => $chaptersHold,
                'nbUser' => $nbUser['nbUser']]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function validComment()
    {
        $id = $_GET['id'];

        $commentManager = new CommentManager();
        $commentManager->noReportComment($id);
        $commentsList = $commentManager->listReportComments();
        $nbComment = $commentManager->commentCount();
        $chapterManager = new ChapterManager();
        $nbChapter = $chapterManager->chapterCount();
        $chaptersHold = $chapterManager->getChaptersHold();
        $userManager = new UserManager();
        $nbUser = $userManager->userCount();

        echo $this->render("admin.twig",
            ['comments' => $commentsList,
                'nbChapter' => $nbChapter['nbChapter'],
                'nbComment' => $nbComment['nbComment'],
                'chaptersHold' => $chaptersHold,
                'nbUser' => $nbUser['nbUser']]);
    }
}
