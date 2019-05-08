<?php

$id = $_GET['id'];

//CREATE CHAPTER OBJECT
require_once ("../src/models/ChapterManager.php");



$chapterManager = new ChapterManager();
require ('../config/dbConnection.php');
$chapter = $chapterManager->getChapter($id);

echo $twig->render("chapter.twig",['chapter' => $chapter]);
