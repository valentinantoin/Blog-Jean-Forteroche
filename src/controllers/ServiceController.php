<?php

use App\Controllers\Controller;
use App\Models\CommentManager;
use App\Models\ChapterManager;
use App\Models\UserManager;



class ServiceController extends Controller {


    public function adminLoad() {

        $commentManager = new CommentManager();
        $commentsList = $commentManager->listReportComments();
        $nbComment = $commentManager->commentCount();
        $chapterManager = new ChapterManager();
        $nbChapter = $chapterManager->chapterCount();
        $userManager = new UserManager();
        $nbUser = $userManager->userCount();


        echo $this->render("admin.twig",
            ['comments' => $commentsList,
            'nbChapter' => $nbChapter['nbChapter'],
                'nbComment' => $nbComment['nbComment'],
                'nbUser' => $nbUser['nbUser']]);
    }

    public function presentationLoad() {

        echo $this->render('presentation.twig');
    }

    public function connectionLoad() {

        echo $this->render('connection.twig');
    }

    public function subscribeLoad() {

        echo $this->render('subscribe.twig');
    }

    public function disconnection() {

        session_destroy();
        header('Location: ../index.php');
    }

}
