<?php

use App\models\CommentManager;

class CommentController {

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

    public function commentList() {

        $id = $_GET['id'];
        $commentManager = new CommentManager();
        $comments = $commentManager->getComment($id);

        echo $this->render("chapter.twig",['comments' => $comments]);

    }
}
