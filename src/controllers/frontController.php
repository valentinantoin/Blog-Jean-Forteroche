<?php

//TEMPLATES
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
        echo $twig->render("home.twig", ['chapters' => chaptersHome()]);
        break;

    case "contact" :
        echo $twig->render("contact.twig");
        break;

    case "chapters" :
        echo $twig->render("chapters.twig", ['chapters' => chaptersPage()]);
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

    default:
        echo $twig->render("home.twig", ['chapters' => chaptersHome()]);
        break;
}
