<?php

//TEMPLATES PREPARATION
$loader = new Twig_Loader_Filesystem( '..\src\views');
$twig = new Twig_Environment($loader, [
    'cache' => false
]);


//ROUTING
$page = 'home';

if(isset($_GET['acces'])) {

    $page = $_GET['acces'];
}

switch ($page) {

    case "home" :
        /*require ("ChapterController.php");
        $chapterController = new ChapterController($twig);
        $chapterLast = $chapterController->chapterLast();*/
        require ("homeController.php");
        break;

    case "contact" :
        require ('contactController.php');
        break;

    case "chapters" :
        require("chapterListController.php");
        break;

    case "chapter" :
        require("readChapterController.php");
        break;

    case "presentation" :
        require ('presentationController.php');
        break;

    case "connection" :
        require ('connectionController.php');
        break;

    case "subscribe" :
        require ('subscribeController.php');
        break;

    case "admin" :
        require ('adminController.php');
        break;

    default:
        require ("homeController.php");
        break;
}
