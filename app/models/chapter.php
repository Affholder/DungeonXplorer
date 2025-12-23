<?php
class Chapter {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getChapterContent($id)
    {
        $query = "SELECT id, content, image FROM Chapter WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

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

    public function getEncounter($chapter_id) {
        $query = "SELECT monster_id, victory_chapter_id, defeat_chapter_id 
                  FROM Encounter 
                  WHERE chapter_id = :chapter_id LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>