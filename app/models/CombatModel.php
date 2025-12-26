<?php

class CombatModel {
    private $pdo;

    public function __construct() {
        $chemins = [
            __DIR__ . '/../../con_db.php',
            __DIR__ . '/../con_db.php',
            __DIR__ . '/../../config/con_db.php',
            __DIR__ . '/../../conf/con_db.php',
            $_SERVER['DOCUMENT_ROOT'] . '/DungeonXplorer/con_db.php'
        ];

        $trouve = false;
        foreach ($chemins as $f) {
            if (file_exists($f)) {
                require $f;
                $trouve = true;
                break;
            }
        }

        if (!$trouve) {
            die("Erreur critique : Impossible de trouver con_db.php. J'ai cherché ici : " . implode(', ', $chemins));
        }

        if (isset($db)) {
            $this->pdo = $db;
        } elseif (isset($pdo)) {
            $this->pdo = $pdo;
        } else {
            die("Erreur : Le fichier con_db.php a été chargé, mais aucune variable \$db ou \$pdo n'a été trouvée dedans.");
        }
    }

    public function getHero($heroId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Hero WHERE id = ?");
        $stmt->execute([$heroId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMonsterById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Monster WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && isset($data['mon_image'])) {
            $data['image'] = $data['mon_image']; 
        }

        return $data;
    }

    public function getRandomMonster() {
        $stmt = $this->pdo->query("SELECT * FROM Monster ORDER BY RAND() LIMIT 1");
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && isset($data['mon_image'])) {
            $data['image'] = $data['mon_image']; 
        }
        
        return $data;
    }

    public function getPotionCount($heroId, $itemId) {
        $stmt = $this->pdo->prepare("SELECT quantity FROM Inventory WHERE hero_id = ? AND item_id = ?");
        $stmt->execute([$heroId, $itemId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? (int)$result['quantity'] : 0;
    }

    public function consumePotion($heroId, $itemId) {
        $stmt = $this->pdo->prepare("UPDATE Inventory SET quantity = quantity - 1 WHERE hero_id = ? AND item_id = ? AND quantity > 0");
        $stmt->execute([$heroId, $itemId]);
        
        $clean = $this->pdo->prepare("DELETE FROM Inventory WHERE hero_id = ? AND item_id = ? AND quantity <= 0");
        $clean->execute([$heroId, $itemId]);
    }

    public function reviveHero($heroId) {
        $stmt = $this->pdo->prepare("UPDATE Hero SET pv = 1 WHERE id = ?");
        $stmt->execute([$heroId]);
    }
    public function getMonsterLoot($monsterId) {
        $sql = "SELECT ml.*, i.name as item_name 
                FROM Monster_Loot ml 
                JOIN Items i ON ml.item_id = i.id 
                WHERE ml.monster_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$monsterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addItemToInventory($heroId, $itemId, $quantity) {
        $stmt = $this->pdo->prepare("SELECT quantity FROM Inventory WHERE hero_id = ? AND item_id = ?");
        $stmt->execute([$heroId, $itemId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $update = $this->pdo->prepare("UPDATE Inventory SET quantity = quantity + ? WHERE hero_id = ? AND item_id = ?");
            $update->execute([$quantity, $heroId, $itemId]);
        } else {
            $insert = $this->pdo->prepare("INSERT INTO Inventory (hero_id, item_id, quantity) VALUES (?, ?, ?)");
            $insert->execute([$heroId, $itemId, $quantity]);
        }
    }
}
?>