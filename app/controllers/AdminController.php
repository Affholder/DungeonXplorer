<?php
class AdminController {
    
    private $db;
    
    public function __construct() {
        // Ne pas charger $db ici dans une variable locale
        // Le laisser global pour que les vues puissent y accéder
    }
    
    // Vérifier si l'utilisateur est admin
    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /DungeonXplorer');
            exit();
        }
        
        // Charger $db globalement
        require_once __DIR__ . '/../../config/con_db.php';
        $this->db = $db;
        
        $stmt = $this->db->prepare("SELECT admin FROM Game_User WHERE User_ID = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || $user['admin'] != 1) {
            header('Location: /DungeonXplorer');
            exit();
        }
    }
    
    // Afficher la page d'administration
    public function index() {
        $this->checkAdmin();
        // Rendre $db accessible globalement pour la vue
        global $db;
        $db = $this->db;
        require_once 'app/views/admin.php';
    }
    
    // === GESTION DES CHAPITRES ===
    
    public function getChapters() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        $stmt = $this->db->query("SELECT * FROM Chapter ORDER BY id ASC");
        $chapters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($chapters);
        exit;
    }
    
    public function addChapter() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'];
            $image = $_POST['image'];
            
            $stmt = $this->db->prepare("INSERT INTO Chapter (content, image) VALUES (?, ?)");
            if ($stmt->execute([$content, $image])) {
                echo json_encode(['success' => true, 'message' => 'Chapitre ajouté']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout']);
            }
        }
        exit;
    }
    
    public function updateChapter() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $content = $_POST['content'];
            $image = $_POST['image'];
            
            $stmt = $this->db->prepare("UPDATE Chapter SET content = ?, image = ? WHERE id = ?");
            if ($stmt->execute([$content, $image, $id])) {
                echo json_encode(['success' => true, 'message' => 'Chapitre modifié']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification']);
            }
        }
        exit;
    }
    
    public function deleteChapter() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            $stmt = $this->db->prepare("DELETE FROM Chapter WHERE id = ?");
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => 'Chapitre supprimé']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
            }
        }
        exit;
    }
    
    // === GESTION DES MONSTRES ===
    
    public function getMonsters() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        $stmt = $this->db->query("SELECT * FROM Monster ORDER BY id ASC");
        $monsters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($monsters);
        exit;
    }
    
    public function addMonster() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $pv = $_POST['pv'];
            $mana = $_POST['mana'];
            $initiative = $_POST['initiative'];
            $strength = $_POST['strength'];
            $attack = $_POST['attack'];
            $xp = $_POST['xp'];
            $mon_image = $_POST['mon_image'];
            
            $stmt = $this->db->prepare("INSERT INTO Monster (name, pv, mana, initiative, strength, attack, xp, mon_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $pv, $mana, $initiative, $strength, $attack, $xp, $mon_image])) {
                echo json_encode(['success' => true, 'message' => 'Monstre ajouté']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout']);
            }
        }
        exit;
    }
    
    public function updateMonster() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $pv = $_POST['pv'];
            $mana = $_POST['mana'];
            $initiative = $_POST['initiative'];
            $strength = $_POST['strength'];
            $attack = $_POST['attack'];
            $xp = $_POST['xp'];
            $mon_image = $_POST['mon_image'];
            
            $stmt = $this->db->prepare("UPDATE Monster SET name = ?, pv = ?, mana = ?, initiative = ?, strength = ?, attack = ?, xp = ?, mon_image = ? WHERE id = ?");
            if ($stmt->execute([$name, $pv, $mana, $initiative, $strength, $attack, $xp, $mon_image, $id])) {
                echo json_encode(['success' => true, 'message' => 'Monstre modifié']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification']);
            }
        }
        exit;
    }
    
    public function deleteMonster() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            $stmt = $this->db->prepare("DELETE FROM Monster WHERE id = ?");
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => 'Monstre supprimé']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
            }
        }
        exit;
    }
    
    // === GESTION DES TRÉSORS ===
    
    public function getTreasures() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        $stmt = $this->db->query("SELECT * FROM Chapter_Treasure ORDER BY chapter_id ASC");
        $treasures = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($treasures);
        exit;
    }
    
    public function addTreasure() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $chapter_id = $_POST['chapter_id'];
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            
            $stmt = $this->db->prepare("INSERT INTO Chapter_Treasure (chapter_id, item_id, quantity) VALUES (?, ?, ?)");
            if ($stmt->execute([$chapter_id, $item_id, $quantity])) {
                echo json_encode(['success' => true, 'message' => 'Trésor ajouté']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout']);
            }
        }
        exit;
    }
    
    public function updateTreasure() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $chapter_id = $_POST['chapter_id'];
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            
            $stmt = $this->db->prepare("UPDATE Chapter_Treasure SET chapter_id = ?, item_id = ?, quantity = ? WHERE id = ?");
            if ($stmt->execute([$chapter_id, $item_id, $quantity, $id])) {
                echo json_encode(['success' => true, 'message' => 'Trésor modifié']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification']);
            }
        }
        exit;
    }
    
    public function deleteTreasure() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            $stmt = $this->db->prepare("DELETE FROM Chapter_Treasure WHERE id = ?");
            if ($stmt->execute([$id])) {
                echo json_encode(['success' => true, 'message' => 'Trésor supprimé']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
            }
        }
        exit;
    }
    
    // === GESTION DES UTILISATEURS ===
    
    public function getUsers() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        $stmt = $this->db->query("SELECT User_ID, username, email, admin FROM Game_User ORDER BY User_ID ASC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
        exit;
    }
    
    public function deleteUser() {
        $this->checkAdmin();
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            
            // Empêcher la suppression de son propre compte
            if ($user_id == $_SESSION['user_id']) {
                echo json_encode(['success' => false, 'message' => 'Vous ne pouvez pas supprimer votre propre compte']);
                exit;
            }
            
            $stmt = $this->db->prepare("DELETE FROM Game_User WHERE User_ID = ?");
            if ($stmt->execute([$user_id])) {
                echo json_encode(['success' => true, 'message' => 'Utilisateur supprimé']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
            }
        }
        exit;
    }
}
?>