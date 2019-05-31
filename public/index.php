<?php

session_start();

use App\Controllers\Router;

//autoload
require_once dirname(__DIR__).'/vendor/autoload.php';

$router = new Router();
$router->run();




