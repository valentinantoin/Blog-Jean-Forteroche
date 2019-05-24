<?php


use App\Models\UserManager;
use App\Controllers\Controller;


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
        $pseudo = $_POST["pseudo"];
        $mail = $_POST["mail"];
        $pass_unchecked = $_POST["pass"];
        $pass_checked = $_POST["pass_check"];

        if ($pass_unchecked === $pass_checked)
        {
            $userManager = new UserManager();
            $test = $userManager->dispoPseudo($pseudo);

            if($test['test'] == 0)
            {
                $pass = password_hash($pass_unchecked, PASSWORD_DEFAULT);

                $userManager = new UserManager();
                $userManager->addUser($pseudo, $mail, $pass);

                header('Location: ../index.php?acces=connection');

            }else
                {
                echo "<script>alert(\"Ce pseudo est déjà pris.. Veuillez en choisir un autre svp. \")</script>";

                echo $this->render('subscribe.twig');
            }
        }else
            {
                echo "<script>alert(\"Les mots de passe ne correspondent pas\")</script>";
            }
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function connection()
    {
        $pseudo = $_POST['pseudo'];

        $userManager = new UserManager();
        $user = $userManager->getUser($pseudo);

        $passwordOk = password_verify($_POST['pass'], $user['pass']);

        if ($passwordOk )
        {
            session_start();
            $_SESSION['pseudo'] = $pseudo;

            if($pseudo == 'Jean' || $pseudo == 'Val' || $pseudo == 'usako' || $pseudo == 'philippe')
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
