<?php


//TEMPLATES PREPARATION
$loader = new Twig_Loader_Filesystem( '../src/views');
$twig = new Twig_Environment($loader, [
    'cache' => false,
]);


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
        $chapterLast = $chapterController->chapterList();
        break;

    case "chapter" :
        require ("ChapterController.php");
        require ("CommentController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterRead();
        break;

    case "presentation" :
        require ('presentationController.php');
        break;

    case "connection" :
        require('connectionView.php');
        break;

    case "subscribe" :
        require ('subscribeController.php');
        break;

    case "admin" :
        require ('adminController.php');
        //require ('ChapterController.php');
        //$chapterController = new ChapterController($twig);
        //$chapterLast = $chapterController->chapterAdd();
        break;

    default:
        require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterLast();
        break;
}
