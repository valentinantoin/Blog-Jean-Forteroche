<?php


require ("../models/ChapterManager.php");


$content = $_POST['content'];
$title = $_POST['title'];

$chapterManager = new ChapterManager();
require ('../config/dbConnection.php');
$addChapter = $chapterManager->addChapter( $title, $content);


header('Location: ../../public/index.php?acces=admin');

