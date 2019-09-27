<?php

namespace App\Controllers;

use Twig\Environment;

/**
 * Class Controller
 * @package App\Controllers
 */
abstract class Controller {

    /**
     * @var \Twig_Environment
     */
    private $twig;


    /**
     * Controller constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $view
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($view, array $params = [])
    {
        return $this->twig->render($view, $params);
    }

    /**
     * @param $message
     */
    public function alert($message)
    {
        $alert = "<script>alert('$message');</script>";
        echo filter_var($alert);
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        $redirect = "<script>window.location = '$url'</script>";
        echo filter_var($redirect);
    }
}
