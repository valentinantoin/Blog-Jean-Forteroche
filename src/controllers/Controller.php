<?php

namespace App\Controllers;

abstract class Controller {

    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        // Stores the Twig engine
        $this->twig = $twig;
    }

    public function render( $view, array $params = [])
    {
        // Returns the rendering of the view
        return $this->twig->render($view, $params);
    }
}
