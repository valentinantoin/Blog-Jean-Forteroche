<?php

namespace config;

use \PDO;

class DbConnection
{

    public function dbConnect()
    {

        $pdo = new PDO('mysql:dbname=anva6816_jeanforteroche;host=localhost', 'anva6816_jeanforteroche', 'jeanjean');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;

    }
}