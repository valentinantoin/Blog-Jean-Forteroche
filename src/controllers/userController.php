<?php

require ("../models/userManager.php");

$pseudo = $_POST["pseudo"];
$mail = $_POST["mail"];
$pass_unchecked = $_POST["pass"];
$pass_checked = $_POST["pass_check"];

if ($pass_unchecked == $pass_checked) {
    $pass = password_hash($pass_unchecked, PASSWORD_DEFAULT);
}else{
    echo "Les passwords ne correspondent pas !";
}



$userManager = new UserManager();
$addUser = $userManager->addUser($pseudo, $mail, $pass);

header('Location: ../../public/index.php?acces=connection');



// COMPARES HASHED PASSWORDS
//$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);