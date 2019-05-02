<?php

//SHOW LAST CHAPTER ON HOME PAGE
function chaptersHome() {

    $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $chapters = $pdo->query('SELECT title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM chapters ORDER BY id DESC LIMIT 1');

    return $chapters;
}

//SHOW EVERY CHAPTER ON CHAPTER PAGE
function chaptersPage() {

    $pdo = new PDO('mysql:dbname=jeanforteroche;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $chapters = $pdo->query('SELECT title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y \') AS creation_date_fr FROM chapters ORDER BY id ASC');

    return $chapters;
}

