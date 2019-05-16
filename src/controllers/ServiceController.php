<?php

require_once ('../src/controllers/Controller.php');
require_once ('../src/models/CommentManager.php');

use App\Controllers\Controller;
use App\Models\CommentManager;



class ServiceController extends Controller {

    public function adminLoad() {

        $commentManager = new CommentManager();
        $commentsList = $commentManager->listReportComments();

        echo $this->render("admin.twig", ['comments' => $commentsList ]);
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
