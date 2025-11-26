<?php
class Chapter {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    // Récupère le texte du chapitre et son image
    public function getChapterContent($id)
    {
        // On récupère id, content, et image
        $query = "SELECT id, content, image FROM Chapter WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère les liens (choix) vers les autres chapitres
    public function getChapterChoices($chapter_id)
    {
        $query = "SELECT next_chapter_id AS chapter, description AS text
                  FROM Links 
                  WHERE chapter_id = :chapter_id";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>