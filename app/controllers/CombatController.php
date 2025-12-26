<?php

require_once __DIR__ . '/../models/CombatModel.php';

class CombatController {
    
    private $model;

    public function __construct() {
        $this->model = new CombatModel();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Inclure la connexion à la base de données
        require __DIR__ . '/../../config/con_db.php';
        
        if (!isset($_SESSION['current_hero_id'])) {
             header('Location: /DungeonXplorer');
             exit;
        }
        $_SESSION['hero_id'] = $_SESSION['current_hero_id']; 

        // Récupérer les informations complètes du héros
        $currentHero = $this->model->getHero($_SESSION['hero_id']);

        require_once __DIR__ . '/../views/header.php';
        require_once __DIR__ . '/../views/combat_view.php';
    }

    public function getCombatData() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        try {
            $heroId = $_SESSION['current_hero_id'] ?? 1;
            $hero = $this->model->getHero($heroId);

            if (!$hero) {
                echo json_encode(['success' => false, 'error' => "Héros introuvable"]);
                exit;
            }

            if (isset($_SESSION['combat_monster_id'])) {
                $monster = $this->model->getMonsterById($_SESSION['combat_monster_id']);
                if (!$monster) $monster = $this->model->getRandomMonster();
            } else {
                echo json_encode(['success' => false, 'error' => "Aucun combat préparé."]);
                exit;
            }

            $id_potion_vie = 10; 
            $id_potion_mana = 20;
            $hero['potions_pv'] = $this->model->getPotionCount($heroId, $id_potion_vie);
            $hero['potions_mana'] = $this->model->getPotionCount($heroId, $id_potion_mana);
            
            $hero['pv_max'] = $hero['pv_max'] ?? 1000; 
            $hero['mana_max'] = $hero['mana_max'] ?? 1000;

            if (!$monster) {
                $monster = ['name' => 'Monstre Test', 'pv' => 50, 'strength' => 5, 'image' => '', 'armor_bonus' => 0];
            }
            $monster['pv_max'] = $monster['pv']; 

            echo json_encode(['success' => true, 'hero' => $hero, 'monster' => $monster]);

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }

    public function usePotion() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $heroId = $_SESSION['current_hero_id'] ?? 1;
        
        $input = json_decode(file_get_contents('php://input'), true);
        $itemId = ($input['type'] === 'pv') ? 10 : 20; 
        
        $this->model->consumePotion($heroId, $itemId);
        echo json_encode(['success' => true]);
        exit;
    }

    public function endCombat() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $input = json_decode(file_get_contents('php://input'), true);
        $winner = $input['winner'] ?? 'monster';
        $heroId = $_SESSION['current_hero_id'] ?? 1;
        $victoryId = $_SESSION['combat_victory_id'] ?? 1;
        $defeatId  = $_SESSION['combat_defeat_id'] ?? 1;
        
        // Initialisation de la réponse
        $response = ['success' => true];

        if ($winner === 'hero') {
            // --- LOGIQUE DE LOOT AJOUTÉE ---
            $droppedItems = [];
            
            if (isset($_SESSION['combat_monster_id'])) {
                $monsterId = $_SESSION['combat_monster_id'];
                $possibleLoot = $this->model->getMonsterLoot($monsterId);

                foreach ($possibleLoot as $loot) {
                    $chance = rand(1, 100); 
                    
                    if ($chance <= ($loot['drop_rate'] * 100)) {
                        $this->model->addItemToInventory($heroId, $loot['item_id'], $loot['quantity']);
                        
                        $droppedItems[] = $loot['quantity'] . "x " . $loot['item_name'];
                    }
                }
            }

            $response['loot'] = $droppedItems;
            $response['redirect'] = "/DungeonXplorer/chapitre/$victoryId";

        } else {
            $this->model->reviveHero($heroId);
            $response['redirect'] = "/DungeonXplorer/chapitre/$defeatId";
        }
        unset($_SESSION['combat_monster_id']);
        unset($_SESSION['combat_victory_id']);
        unset($_SESSION['combat_defeat_id']);
        
        echo json_encode($response);
        exit;
    }
}
?>