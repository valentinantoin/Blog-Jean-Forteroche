<?php


use App\models\ChapterManager;

$chapterManager = new ChapterManager();
require ('../config/dbConnection.php');
$lastChapter = $chapterManager->getLastChapter();

echo $twig->render("home.twig",['chapters' => $lastChapter]);
