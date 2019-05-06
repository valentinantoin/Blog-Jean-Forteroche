<?php

//CREATE CHAPTER OBJECT
require_once ("../src/models/ChapterManager.php");

$chapterManager = new ChapterManager();
$lastChapter = $chapterManager->getLastChapter();

echo $twig->render("home.twig",['chapters' => $lastChapter]);
