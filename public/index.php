<?php

require "../vendor/autoload.php";


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


require ("../src/controllers/frontController.php");
