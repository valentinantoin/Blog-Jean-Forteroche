<?php


//TEMPLATES PREPARATION
$loader = new Twig_Loader_Filesystem( '..\src\views');
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
        require ('presentationController.php');
        break;

    case "connection" :
        require('connectionView.php');
        break;

    case "disconnect" :
        session_destroy();
        header('Location: ../public/index.php');
        break;

    case "subscribe" :
        require ('subscribeController.php');
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

    case "admin" :
        require ('adminController.php');
        break;

    default:
        require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterLast();
        break;
}
