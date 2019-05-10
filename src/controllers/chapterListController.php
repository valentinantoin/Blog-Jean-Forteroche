<?php

//CREATE CHAPTER OBJECT
use App\models\ChapterManager;

$chapterManager = new ChapterManager();
require ('../config/dbConnection.php');
$chapters = $chapterManager->getChapterPage();

echo $twig->render("chapters.twig",['chapters' => $chapters]);
