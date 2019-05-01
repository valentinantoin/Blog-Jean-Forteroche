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



function chapters() {

    $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $chapters = $pdo->query('SELECT * FROM chapters ORDER BY id DESC LIMIT 3');

    return $chapters;
}

switch ($page) {

    case "home" :
        echo $twig->render("home.twig", ['chapters' => chapters()]);
        break;

    case "contact" :
        echo $twig->render("contact.twig");
        break;

    default:
        echo $twig->render("home.twig", ['chapters' => chapters()]);
        break;
}

