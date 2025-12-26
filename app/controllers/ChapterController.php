<?php
require_once __DIR__.'/../models/chapter.php';

class ChapterController {
    
    public function save($id, $db){
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if(isset($_SESSION['current_hero_id'])){
            $hero_id = $_SESSION['current_hero_id'];
        } else {
            $_SESSION['error'] = "L'utilisateur ne possède pas de héros";
            exit();
        }
        $stmt = "INSERT INTO Hero_Progress(hero_id, chapter_id, played_at) VALUES(:heroid, :chapterid, NOW())";
        $req = $db->prepare($stmt);
        $req->bindParam(':heroid', $hero_id);
        $req->bindParam(':chapterid', $id);
        $req->execute();
    }
    
    public function show($id) {
        require __DIR__ . '/../../config/con_db.php';
        
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if(isset($_SESSION['current_hero_id'])){
            $hero_id = $_SESSION['current_hero_id'];
        } else {
            $_SESSION['error'] = "L'utilisateur ne possède pas de héros";
            header("Location: /DungeonXplorer"); 
            exit();
        }

        $chapterModel = new Chapter($db);
        if (isset($_SESSION['last_chapter_id']) && $_SESSION['last_chapter_id'] != $id) {
            $previous_id = $_SESSION['last_chapter_id'];
            
            $loot = $chapterModel->getChapterLoot($previous_id);
            
            if ($loot) {
                $chapterModel->addLootToInventory($hero_id, $loot['item_id'], $loot['quantity']);
                
                $_SESSION['loot_alert'] = "En quittant les lieux, vous avez ramassé : " . $loot['item_name'] . " (x" . $loot['quantity'] . ")";
            }
        }
        $_SESSION['last_chapter_id'] = $id;
        $encounter = $chapterModel->getEncounter($id);

        if ($encounter) {
            $_SESSION['combat_monster_id'] = $encounter['monster_id'];
            $_SESSION['combat_victory_id'] = $encounter['victory_chapter_id'];
            $_SESSION['combat_defeat_id']  = $encounter['defeat_chapter_id']; 
        } else {
            unset($_SESSION['combat_monster_id']);
            unset($_SESSION['combat_victory_id']);
            unset($_SESSION['combat_defeat_id']);
        }

        $chapter = $chapterModel->getChapterContent($id);
        $choices = $chapterModel->getChapterChoices($id);
        $this->save($id, $db);
        
        if (!$chapter) {
            header("Location: /DungeonXplorer"); 
            exit();
        }
        
        require 'app/views/chapter.php';
    }

    public function load(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if(isset($_SESSION['current_hero_id'])){
            $hero_id = $_SESSION['current_hero_id'];
        } else {
            $_SESSION['error'] = "L'utilisateur ne possède pas de héros";
            header("Location: /DungeonXplorer"); 
            exit();
        }
        
        require_once __DIR__ . '/../../config/con_db.php';
        
        $stmt = "SELECT chapter_id FROM Hero_Progress 
                 WHERE hero_id = :heroid 
                 ORDER BY played_at DESC 
                 LIMIT 1";
        
        $req = $db->prepare($stmt);
        $req->bindParam(':heroid', $hero_id);
        $req->execute();
        
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        if ($result && isset($result['chapter_id'])) {
            $this->show($result['chapter_id']);
        } else {
            $_SESSION['error'] = "Aucune progression trouvée";
            header("Location: /DungeonXplorer/chapitre/1");
            exit();
        }
    }
}
?>