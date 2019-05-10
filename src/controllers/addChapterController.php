<?php


$content = $_POST['content'];
$title = $_POST['title'];

use App\models\ChapterManager;

$chapterManager = new ChapterManager();

require_once ('../../config/dbConnection.php');

$addChapter = $chapterManager->addChapter( $title, $content);

header('Location: ../../public/index.php?acces=admin');