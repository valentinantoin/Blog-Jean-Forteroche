<?php

//TEMPLATES PREPARATION
$loader = new Twig_Loader_Filesystem( '..\src\views');
$twig = new Twig_Environment($loader, [
    'cache' => false
]);

//CREATE CHAPTER OBJECT
require_once ("../src/models/ChapterManager.php");

    $chapterManager = new ChapterManager();
    $lastChapter = $chapterManager->getChapterHome();
    $chapters = $chapterManager->getChapterPage();


//ROUTING
$page = 'home';

if(isset($_GET['acces'])) {

    $page = $_GET['acces'];
}

switch ($page) {

    case "home" :
        echo $twig->render("home.twig", ['chapters' => $lastChapter]);
        break;

    case "contact" :
        echo $twig->render("contact.twig");
        break;

    case "chapters" :
        echo $twig->render("chapters.twig", ['chapters' => $chapters]);
        break;

    case "chapter" :
        echo $twig->render("chapter.twig");
        break;

    case "presentation" :
        echo $twig->render("presentation.twig");
        break;

    case "connection" :
        echo $twig->render("connection.twig");
        break;

    case "subscribe" :
        echo $twig->render("subscribe.twig");
        break;

    case "admin" :
        echo $twig->render("admin.twig");
        break;

    default:
        echo $twig->render("home.twig", ['chapters' => $lastChapter]);
        break;
}
