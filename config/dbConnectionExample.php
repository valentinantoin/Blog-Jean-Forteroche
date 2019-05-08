<?php

function dbConnect() {

    $pdo = new PDO('mysql:dbname=example ;host=example', 'example', 'example');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    return $pdo;

}
