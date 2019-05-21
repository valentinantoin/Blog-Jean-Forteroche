<?php

use App\Controllers\Controller;


/**
 * Class ContactController
 */
class ContactController extends Controller
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendMail()
    {
        $name = htmlentities($_POST['name']);
        $mail = htmlentities($_POST['mail']);
        $title = htmlentities($_POST['title']);
        $content = htmlentities($_POST['message']);

        $to = "valentin.antoin@gmail.com";
        $subject = $title;
        $message = $content;

        $header = 'MIME-Version: 1.0'."\r\n";
        $header .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $header .= 'From: '.$name.' <'.$mail.'>'."\r\n";

        mail($to,$subject,$message, $header);

        echo "<script>alert(\"Votre mail est bien envoyé\")</script>";

        echo $this->render('contact.twig');
    }
}