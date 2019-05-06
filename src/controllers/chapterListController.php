<?php

//CREATE CHAPTER OBJECT
require_once ("../src/models/ChapterManager.php");

$chapterManager = new ChapterManager();
$chapters = $chapterManager->getChapterPage();

echo $twig->render("chapters.twig",['chapters' => $chapters]);
