<?php

$id = $_GET['id'];

use App\models\ChapterManager;



$chapterManager = new ChapterManager();
require ('../config/dbConnection.php');
$chapter = $chapterManager->getChapter($id);

echo $twig->render("chapter.twig",['chapter' => $chapter]);
