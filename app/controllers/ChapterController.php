<?php
// app/controllers/ChapterController.php
require_once __DIR__.'/../models/chapter.php';

class ChapterController {
    
    public function save($id, $db){
        session_start();
        // Vérification de la session hero_id
        if(isset($_SESSION['current_hero_id'])){
            $hero_id = $_SESSION['current_hero_id'];
        }
        else{
            $_SESSION['error'] = "L'utilisateur ne possède pas de héros";
            //header("Location: /DungeonXplorer"); 
            exit();
        }
                
        $stmt = "INSERT INTO Hero_Progress(hero_id, chapter_id) VALUES(:heroid, :chapterid)";
        $req = $db->prepare($stmt);
        $req->bindParam(':heroid', $hero_id);
        $req->bindParam(':chapterid', $id);
        
        if ($req->execute()) {
            return true;
        } else {
            $_SESSION['error'] = "Echec de l'insertion.";
            return false;
        }
    }
    
    public function show($id) {
        require_once __DIR__ . '/../../config/con_db.php';
        $chapterModel = new Chapter($db);
        $chapter = $chapterModel->getChapterContent($id);
        $choices = $chapterModel->getChapterChoices($id);
        
        $this->save($id, $db);
        
        if (!$chapter) {
            header("Location: /DungeonXplorer"); 
            exit();
        }
        
        require 'app/views/chapter.php';
    }
}
?>