<?php

namespace App\Controllers;

use App\Models\UserManager;


/**
 * Class UserController
 */
class UserController extends Controller {

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function subscribe()
    {
        $pseudo = filter_input(INPUT_POST,'pseudo');
        $mail = filter_input(INPUT_POST,'mail');
        $pass_unchecked = filter_input(INPUT_POST,'pass');
        $pass_checked = filter_input(INPUT_POST,'pass_check');

        if ($pass_unchecked === $pass_checked)
        {
            $userManager = new UserManager();
            $test = $userManager->dispoPseudo($pseudo);

            if($test['test'] == 0)
            {
                $pass = password_hash($pass_unchecked, PASSWORD_DEFAULT);

                $userManager = new UserManager();
                $userManager->addUser($pseudo, $mail, $pass);

                header('Location: ../index.php?access=connection');

            }else
                {
                echo "<script>alert(\"Ce pseudo est déjà pris.. Veuillez en choisir un autre svp. \")</script>";

                echo $this->render('subscribe.twig');
            }
        }else
            {
                echo "<script>alert(\"Les mots de passe ne correspondent pas\")</script>";

                echo $this->render('subscribe.twig');
            }
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function connection()
    {
        $pseudo = filter_input(INPUT_POST,'pseudo');

        $userManager = new UserManager();
        $user = $userManager->getUser($pseudo);

        $passwordOk = password_verify(filter_input(INPUT_POST,'pass'), $user['pass']);

        if ($passwordOk )
        {
            session_start();
            $_SESSION['pseudo'] = $pseudo;

            if($user['id'] < 2)
            {
                $_SESSION['admin'] = true;
            }

            header('Location: ../index.php');

        }if (!$passwordOk)
        {
            echo "<script>alert(\"Identifiant ou mot de passe incorrect !\")</script>";

            echo $this->render('connection.twig');
        }
    }
}
