<?php


//TEMPLATES PREPARATION
$loader = new Twig_Loader_Filesystem( '../src/Views');
$twig = new Twig_Environment($loader, [
    'cache' => false,
    'debug' => true,
]);
$twig->addGlobal('session', $_SESSION);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$filter = new \Twig\TwigFilter('nl2br', 'nl2br', ['is_safe' => ['html']]);
$twig->addFilter($filter);


//ROUTING
$page = 'home';

if(isset($_GET['acces'])) {

    $page = $_GET['acces'];
}

switch ($page) {

    case "home" :
        require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterLast();
        break;

    case "chapters" :
        require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterList = $chapterController->chapterList();
        break;

    case "chapter" :
        require ("ChapterController.php");
        require ("CommentController.php");
        $chapterController = new ChapterController($twig);
        $chapterRead = $chapterController->chapterRead();
        break;

    case "presentation" :
        require ('ServiceController.php');
        $serviceController = new ServiceController($twig);
        $serviceController->presentationLoad();
        break;

    case "connection" :
        require ('ServiceController.php');
        $serviceController = new ServiceController($twig);
        $serviceController->connectionLoad();
        break;

    case "disconnect" :
        require ('ServiceController.php');
        $serviceController = new ServiceController($twig);
        $serviceController->disconnection();
        break;

    case "subscribe" :
        require ('ServiceController.php');
        $serviceController = new ServiceController($twig);
        $serviceController->subscribeLoad();
        break;

    case "postsubscribe" :
        require ('UserController.php');
        $userController = new UserController($twig);
        $addUser = $userController->subscribe();
        break;

    case "connected" :
        require ('UserController.php');
        $userController = new UserController($twig);
        $addUser = $userController->connection();
        break;

    case "postchap" :
        require ('ChapterController.php');
        $chapterController = new ChapterController($twig);
        $addChapter = $chapterController->chapterAdd();
        break;

    case "postcom" :
        require ('CommentController.php');
        $commentController = new CommentController($twig);
        $addComment = $commentController->addComment();
        break;

    case "reportcom" :
        require ('CommentController.php');
        $commentController = new CommentController($twig);
        $reportComment = $commentController->reportComment();
        break;

    case "valcom" :
        require ('CommentController.php');
        $commentController = new CommentController($twig);
        $commentController->validComment();
        break;

    case "delcom" :
        require ('CommentController.php');
        $commentController = new CommentController($twig);
        $commentController->deleteComment();
        break;

    case "admin" :
        require ('ServiceController.php');
        $serviceController = new ServiceController($twig);
        $adminPage = $serviceController->AdminLoad();
        break;

    default:
        require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterLast();
        break;
}
