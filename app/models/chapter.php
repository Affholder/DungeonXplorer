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

    // Récupère les infos du butin pour un chapitre donné
    public function getChapterLoot($chapter_id)
    {
        // On joint avec la table Items pour récupérer le nom de l'objet pour l'alerte
        // (J'assume que ta table s'appelle 'Items' et a une colonne 'name', adapte si besoin)
        $query = "SELECT t.item_id, t.quantity, i.name as item_name 
                  FROM Chapter_Treasure t
                  JOIN Items i ON t.item_id = i.id
                  WHERE t.chapter_id = :chapter_id LIMIT 1";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addLootToInventory($hero_id, $item_id, $quantity)
    {
        $checkQuery = "SELECT id, quantity FROM Inventory 
                       WHERE hero_id = :hero_id AND item_id = :item_id";
        $stmt = $this->db->prepare($checkQuery);
        $stmt->bindParam(':hero_id', $hero_id);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $updateQuery = "UPDATE Inventory SET quantity = quantity + :quantity WHERE id = :inv_id";
            $req = $this->db->prepare($updateQuery);
            $req->bindParam(':quantity', $quantity);
            $req->bindParam(':inv_id', $existing['id']);
            $req->execute();
        } else {
            $insertQuery = "INSERT INTO Inventory (hero_id, item_id, quantity) VALUES (:hero_id, :item_id, :quantity)";
            $req = $this->db->prepare($insertQuery);
            $req->bindParam(':hero_id', $hero_id);
            $req->bindParam(':item_id', $item_id);
            $req->bindParam(':quantity', $quantity);
            $req->execute();
        }
    }
}
?>