<?php

namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\ChapterManager;
use App\Models\UserManager;


/**
 * Class ServiceController
 */
class ServiceController extends Controller {


    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function adminLoad()
    {
        $commentManager = new CommentManager();
        $commentsList = $commentManager->listReportComments();
        $nbComment = $commentManager->commentCount();
        $nbCommentPb = $commentManager->commentPbCount();
        $chapterManager = new ChapterManager();
        $nbChapter = $chapterManager->chapterCount();
        $nbChapterHold = $chapterManager->chapterHoldCount();
        $chaptersHold = $chapterManager->getChaptersHold();
        $userManager = new UserManager();
        $nbUser = $userManager->userCount();

        return $this->render("admin.twig",
            ['comments' => $commentsList,
            'nbChapter' => $nbChapter['nbChapter'],
                'nbChapterHold' => $nbChapterHold['nbChapterHold'],
                'chaptersHold' => $chaptersHold,
                'nbComment' => $nbComment['nbComment'],
                'nbCommentPb' => $nbCommentPb['nbCommentPb'],
                'nbUser' => $nbUser['nbUser']]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function presentationLoad()
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter(1);

        return $this->render('presentation.twig', ['presentation' => $chapter]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function connectionLoad()
    {
        return $this->render('connection.twig');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function subscribeLoad()
    {
        return $this->render('subscribe.twig');
    }


    /**
     *
     */
    public function disconnection()
    {
        session_destroy();

        header('Location: ../index.php');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function contactLoad()
    {
        return $this->render('contact.twig');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendMail()
    {
        $name = htmlentities(filter_input(INPUT_POST,'name'));
        $mail = htmlentities(filter_input(INPUT_POST,'mail'));
        $content = htmlentities(filter_input(INPUT_POST,'message'));

        $from = "anva6816@melon.o2switch.net";
        $to = "valentin.antoin@gmail.com";
        $subject = 'message de ' .$name.' <'.$mail.'>';
        $message = $content;

        $header = 'MIME-Version: 1.0'."\r\n";
        $header .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $header .= 'From: '.$from."\r\n";

        mail($to,$subject,$message, $header);

        $this->alert('Votre mail est bien envoyé.');

        return $this->render('contact.twig');
    }
}
