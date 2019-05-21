<?php

namespace App\Controllers;

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
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
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
}
