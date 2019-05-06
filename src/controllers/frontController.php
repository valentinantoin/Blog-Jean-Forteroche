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
        require ("homeController.php");
        break;

    case "contact" :
        echo $twig->render("contact.twig");
        break;

    case "chapters" :
        require("chapterListController.php");
        break;

    case "chapter" :
        require("readChapterController.php");
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
        require ("homeController.php");
        break;
}
