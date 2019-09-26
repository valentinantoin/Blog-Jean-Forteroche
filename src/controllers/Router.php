<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;


class Router {

    public function run() {


        $loader = new FilesystemLoader( '../src/Views');
        $twig = new Environment($loader, [
            //'cache' => false,
            'debug' => false
        ]);
        $twig->addGlobal('session', $_SESSION);
        $twig->addExtension(new DebugExtension());
        $filter = new TwigFilter('nl2br', 'nl2br', ['is_safe' => ['html']]);
        $twig->addFilter($filter);

        $page = 'home';

        if(isset($_GET['access'])) {

            $page = filter_input(INPUT_GET,'access');
        }

        switch ($page) {

            case "home" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterLast();
                break;

            case "contact" :
                $serviceController = new ServiceController($twig);
                $serviceController->contactLoad();
                break;

            case "sendmail" :
                $contactController = new ServiceController($twig);
                $contactController->sendMail();
                break;

            case "chapters" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterList();
                break;

            case "chapter" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterRead();
                break;

            case "presentation" :
                $serviceController = new ServiceController($twig);
                $serviceController->presentationLoad();
                break;

            case "connection" :
                $serviceController = new ServiceController($twig);
                $serviceController->connectionLoad();
                break;

            case "disconnect" :
                $serviceController = new ServiceController($twig);
                $serviceController->disconnection();
                break;

            case "subscribe" :
                $serviceController = new ServiceController($twig);
                $serviceController->subscribeLoad();
                break;

            case "postsubscribe" :
                $userController = new UserController($twig);
                $userController->subscribe();
                break;

            case "connected" :
                $userController = new UserController($twig);
                $userController->connection();
                break;

            case "postchap" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterAdd();
                break;

            case "savechap" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterSave();
                break;

            case "resavechap" :
                $chapterController = new ChapterController($twig);
                $chapterController->updateChapHold();
                break;

            case "delchap" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterDelete();
                break;

            case "postcom" :
                $commentController = new CommentController($twig);
                $commentController->addComment();
                break;

            case "reportcom" :
                $commentController = new CommentController($twig);
                $commentController->reportComment();
                break;

            case "valcom" :
                $commentController = new CommentController($twig);
                $commentController->validComment();
                break;

            case "delcom" :
                $commentController = new CommentController($twig);
                $commentController->deleteComment();
                break;

            case "modchap" :
                $chapterController = new ChapterController($twig);
                $chapterController->chapterModify();
                break;

            case "upchap" :
                $chapterController = new ChapterController($twig);
                $chapterController->updateChapter();
                break;

            case "admin" :
                if (isset($_SESSION['admin'])) {
                    $serviceController = new ServiceController($twig);
                    $serviceController->AdminLoad();
                }else {
                    $chapterController = new ChapterController($twig);
                    $chapterController->chapterLast();
                }
                break;

            default:
                $chapterController = new ChapterController($twig);
                $chapterController->chapterLast();
                break;
        }
    }
}
