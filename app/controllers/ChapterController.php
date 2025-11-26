<?php
// app/controllers/ChapterController.php

require_once __DIR__.'/../models/chapter.php';

class ChapterController {

    public function show($id) {
        require_once __DIR__ . '/../../config/con_db.php';

       $chapterModel = new Chapter($db);

        $chapter = $chapterModel->getChapterContent($id);
        $choices = $chapterModel->getChapterChoices($id);

        if (!$chapter) {
            header("Location: /DungeonXplorer"); 
            exit();
        }

        require 'app/views/chapter.php';
    }
}
?>