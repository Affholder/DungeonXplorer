<?php
require_once __DIR__ . '/../../config/con_db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['current_hero_id'])) {
    echo json_encode(['error' => 'Aucun héros sélectionné']);
    exit;
}

$hero_id = $_SESSION['current_hero_id'];
$action = $_POST['action'] ?? '';
$item_id = intval($_POST['item_id'] ?? 0);

// Récupérer les stats actuelles du héros
$heroQuery = $db->prepare("SELECT * FROM Hero WHERE id = ?");
$heroQuery->execute([$hero_id]);
$hero = $heroQuery->fetch(PDO::FETCH_ASSOC);

if (!$hero) {
    echo json_encode(['error' => 'Héros non trouvé']);
    exit;
}

// Vérifier si le héros est en combat (si la colonne existe et n'est pas nulle)
$inCombat = !empty($hero['combat_id']);

try {
    $db->beginTransaction();

    if ($action === 'equip') {
        // Restriction : On ne change pas d'équipement en plein combat
        if ($inCombat) {
            echo json_encode(['error' => 'Impossible de changer d\'équipement pendant un combat !']);
            $db->rollBack();
            exit;
        }

        // Vérifier que l'item appartient au héros
        $checkItem = $db->prepare("SELECT quantity FROM Inventory WHERE hero_id = ? AND item_id = ? AND quantity > 0");
        $checkItem->execute([$hero_id, $item_id]);
        if (!$checkItem->fetch()) {
            echo json_encode(['error' => 'Item non trouvé dans l\'inventaire']);
            $db->rollBack();
            exit;
        }

        // Récupérer les infos de l'item
        $itemQuery = $db->prepare("SELECT * FROM Items WHERE id = ?");
        $itemQuery->execute([$item_id]);
        $item = $itemQuery->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            echo json_encode(['error' => 'Item invalide']);
            $db->rollBack();
            exit;
        }

        // Déterminer le slot selon le type d'item
        $slot = '';
        
        switch($item['item_type']) {
            case 'Armure':
                $slot = 'armor_item_id';
                break;
            case 'Arme':
                // Pour les armes, vérifier quel slot est disponible
                if (!$hero['primary_weapon_item_id']) {
                    $slot = 'primary_weapon_item_id';
                } elseif (!$hero['secondary_weapon_item_id']) {
                    $slot = 'secondary_weapon_item_id';
                } else {
                    $slot = 'primary_weapon_item_id';
                }
                break;
            case 'Bouclier':
                $slot = 'shield_item_id';
                break;
            default:
                echo json_encode(['error' => 'Cet item ne peut pas être équipé']);
                $db->rollBack();
                exit;
        }

        // Déséquiper l'item actuel si présent
        $currentItemId = $hero[$slot];
        if ($currentItemId) {
            $addBack = $db->prepare("
                INSERT INTO Inventory (hero_id, item_id, quantity) 
                VALUES (?, ?, 1)
                ON DUPLICATE KEY UPDATE quantity = quantity + 1
            ");
            $addBack->execute([$hero_id, $currentItemId]);
        }

        // Équiper le nouvel item
        $equipQuery = $db->prepare("UPDATE Hero SET $slot = ? WHERE id = ?");
        $equipQuery->execute([$item_id, $hero_id]);

        // Retirer de l'inventaire
        $removeQuery = $db->prepare("
            UPDATE Inventory 
            SET quantity = quantity - 1 
            WHERE hero_id = ? AND item_id = ?
        ");
        $removeQuery->execute([$hero_id, $item_id]);

        // Supprimer si quantité = 0
        $deleteQuery = $db->prepare("DELETE FROM Inventory WHERE hero_id = ? AND item_id = ? AND quantity <= 0");
        $deleteQuery->execute([$hero_id, $item_id]);

        $db->commit();
        echo json_encode(['success' => true, 'message' => $item['name'] . ' équipé avec succès']);

    } elseif ($action === 'use') {
        // Vérifier que l'item appartient au héros
        $checkItem = $db->prepare("SELECT quantity FROM Inventory WHERE hero_id = ? AND item_id = ? AND quantity > 0");
        $checkItem->execute([$hero_id, $item_id]);
        if (!$checkItem->fetch()) {
            echo json_encode(['error' => 'Item non trouvé dans l\'inventaire']);
            $db->rollBack();
            exit;
        }

        // Récupérer les infos de l'item
        $itemQuery = $db->prepare("SELECT * FROM Items WHERE id = ?");
        $itemQuery->execute([$item_id]);
        $item = $itemQuery->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            echo json_encode(['error' => 'Item invalide']);
            $db->rollBack();
            exit;
        }

        if (in_array($item['item_type'], ['Armure', 'Arme', 'Bouclier'])) {
            echo json_encode(['error' => 'Cet item doit être équipé, pas utilisé']);
            $db->rollBack();
            exit;
        }

        $newPv = $hero['pv'];
        $newMana = $hero['mana'];
        $message = '';
        $logMessage = ''; // Pour le log de combat

        // Item spécial ID 20
        if ($item_id == 20) {
            $newPv = $hero['pv_max'];
            $newMana = $hero['mana_max'];
            $message = 'PV et Mana complètement restaurés !';
            $logMessage = "utilise {$item['name']} et restaure tous ses PV/Mana.";
        } else {
            $hpGained = 0;
            $manaGained = 0;

            if ($item['bonus_pv'] > 0) {
                $hpGained = min($item['bonus_pv'], $hero['pv_max'] - $hero['pv']);
                $newPv = min($hero['pv'] + $item['bonus_pv'], $hero['pv_max']);
                if ($hpGained > 0) {
                    $message .= '+' . $hpGained . ' PV. ';
                }
            }
            
            if ($item['bonus_mana'] > 0) {
                $manaGained = min($item['bonus_mana'], $hero['mana_max'] - $hero['mana']);
                $newMana = min($hero['mana'] + $item['bonus_mana'], $hero['mana_max']);
                if ($manaGained > 0) {
                    $message .= '+' . $manaGained . ' Mana. ';
                }
            }

            if (empty($message)) {
                $message = 'Item utilisé mais aucun effet applicable.';
                $logMessage = "utilise {$item['name']} mais rien ne se passe.";
            } else {
                // Construction du message pour le log de combat
                $logMessage = "utilise {$item['name']}. " . $message;
            }
        }

        // Mettre à jour les stats du héros
        $updateHero = $db->prepare("
            UPDATE Hero 
            SET pv = ?, mana = ?
            WHERE id = ?
        ");
        $updateHero->execute([$newPv, $newMana, $hero_id]);

        // Retirer l'item de l'inventaire
        $removeQuery = $db->prepare("
            UPDATE Inventory 
            SET quantity = quantity - 1 
            WHERE hero_id = ? AND item_id = ?
        ");
        $removeQuery->execute([$hero_id, $item_id]);

        // Supprimer si quantité = 0
        $deleteQuery = $db->prepare("DELETE FROM Inventory WHERE hero_id = ? AND item_id = ? AND quantity <= 0");
        $deleteQuery->execute([$hero_id, $item_id]);

        // --- NOUVEAU : GESTION DU LOG DE COMBAT ---
        if ($inCombat) {
            // Insérer l'action dans les logs de combat pour que l'interface de combat se mette à jour
            $insertLog = $db->prepare("INSERT INTO CombatLogs (combat_id, message) VALUES (?, ?)");
            $insertLog->execute([$hero['combat_id'], "Le héros " . $logMessage]);
        }
        // ------------------------------------------

        $db->commit();
        echo json_encode([
            'success' => true, 
            'message' => trim($message),
            'newPv' => $newPv,
            'newMana' => $newMana,
            'inCombat' => $inCombat // Utile pour le frontend pour savoir s'il doit recharger la zone de combat
        ]);

    } elseif ($action === 'unequip') {
        
        // Restriction : On ne déséquipe pas en combat
        if ($inCombat) {
            echo json_encode(['error' => 'Impossible de changer d\'équipement pendant un combat !']);
            $db->rollBack();
            exit;
        }

        $slot = $_POST['slot'] ?? '';
        
        $validSlots = ['armor_item_id', 'primary_weapon_item_id', 'secondary_weapon_item_id', 'shield_item_id'];
        if (!in_array($slot, $validSlots)) {
            echo json_encode(['error' => 'Slot invalide']);
            $db->rollBack();
            exit;
        }

        $currentItemId = $hero[$slot];
        if (!$currentItemId) {
            echo json_encode(['error' => 'Aucun item équipé dans ce slot']);
            $db->rollBack();
            exit;
        }

        // Remettre l'item dans l'inventaire
        $addBack = $db->prepare("
            INSERT INTO Inventory (hero_id, item_id, quantity) 
            VALUES (?, ?, 1)
            ON DUPLICATE KEY UPDATE quantity = quantity + 1
        ");
        $addBack->execute([$hero_id, $currentItemId]);

        // Déséquiper
        $unequipQuery = $db->prepare("UPDATE Hero SET $slot = NULL WHERE id = ?");
        $unequipQuery->execute([$hero_id]);

        $db->commit();
        echo json_encode(['success' => true, 'message' => 'Item déséquipé avec succès']);

    } else {
        echo json_encode(['error' => 'Action invalide']);
        $db->rollBack();
        exit;
    }

} catch (Exception $e) {
    $db->rollBack();
    echo json_encode(['error' => 'Erreur: ' . $e->getMessage()]);
}
?>