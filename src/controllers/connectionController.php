<?php

use App\models\UserManager;
require ('../models/UserManager.php');

$pseudo = $_POST['pseudo'];
$pass = $_POST['pass'];
$hashPass = password_hash($pass, PASSWORD_DEFAULT);


$userManager = new UserManager();
$userPass = $userManager->getUser($pseudo);

if ($hashPass == $userPass ){

    session_start();
    $_SESSION['pseudo'] = $pseudo;


    header('Location: ../../public/index.php');
}else {

    echo "Mot de passe incorrect.";
}
