<?php

session_start();

//autoload
require_once dirname(__DIR__).'/vendor/autoload.php';


//load front controller for routing
require("../src/router.php");



