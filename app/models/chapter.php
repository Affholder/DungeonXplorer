<?php
class Chapter{

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    //récupère le texte du chapitre et son image
    public function getChapterContent($id)
    {
        $query = "SELECT id, content, image FROM Chapter WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //récupère les liens entre chapitres
    public function getChapterChoices($chapter_id)
    {
        $query = "SELECT L.next_chapter_id AS chapter, L.description AS text
                  FROM Links L
                  WHERE L.chapter_id = :chapter_id";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>