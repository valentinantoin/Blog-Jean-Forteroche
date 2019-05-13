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

        echo $this->render("chapter.twig",['comments' => $comments]); //FUNCTION CALL IN CHAPTERCONTROLLER !!!

    }

    public function addComment() {

        $id = $_GET['id'];
        $content = $_POST['content'];
        $commentManager = new CommentManager();
        $commentManager->addComment($id, $_SESSION['pseudo'], $content);

        header('Location: ../../public/index.php?acces=chpter&id='. $id .'');



    }

}