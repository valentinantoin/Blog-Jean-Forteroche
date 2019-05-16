<?php


use App\Models\UserManager;
require_once ('../src/models/UserManager.php');
use App\Controllers\Controller;
require_once ('../src/controllers/Controller.php');


class UserController extends Controller {

    public function subscribe() {

        $pseudo = $_POST["pseudo"];
        $mail = $_POST["mail"];
        $pass_unchecked = $_POST["pass"];
        $pass_checked = $_POST["pass_check"];

        if ($pass_unchecked === $pass_checked) {

            $pass = password_hash($pass_unchecked, PASSWORD_DEFAULT);

            $userManager = new UserManager();
            $userManager->addUser($pseudo, $mail, $pass);


            header('Location: ../index.php?acces=connection');

        }else{

            echo "Les passwords ne correspondent pas !";
        }
    }

    public function connection() {

        $pseudo = $_POST['pseudo'];

        $userManager = new UserManager();
        $user = $userManager->getUser($pseudo);


        $passwordOk = password_verify($_POST['pass'], $user['pass']);

        if ($passwordOk ){

            session_start();
            $_SESSION['pseudo'] = $pseudo;

            if($pseudo == 'Jean' || $pseudo == 'Val' || $pseudo == 'usako' || $pseudo == 'philippe') {

                $_SESSION['admin'] = true;
            }


            header('Location: ../index.php');


        }if (!$passwordOk) {

            $message = "Identifiant ou mot de passe incorrect !";

            echo $this->render('connection.twig', ['error' => $message]);
        }


    }
}


// COMPARES HASHED PASSWORDS
//$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);