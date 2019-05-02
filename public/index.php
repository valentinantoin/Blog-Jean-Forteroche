<?php

require "../vendor/autoload.php";

//ROUTING
$page = 'home';

    if(isset($_GET['acces'])) {

        $page = $_GET['acces'];
}


//TEMPLATE

$loader = new Twig_Loader_Filesystem(__DIR__. '../../src/views');
    $twig = new Twig_Environment($loader, [
        'cache' => false
    ]);



function chaptersHome() {

    $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $chapters = $pdo->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 3');

    return $chapters;
}

function chaptersPage() {

    $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $chapters = $pdo->query('SELECT * FROM chapters ORDER BY id ASC');

    return $chapters;
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

