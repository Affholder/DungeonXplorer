<?php
require_once __DIR__ . '/../../config/con_db.php';
session_start();

// Vérifier que l'utilisateur a sélectionné un héros
if (!isset($_SESSION['current_hero_id'])) {
    echo '<div class="error-message">';
    echo '<p>Veuillez d\'abord sélectionner un personnage.</p>';
    echo '<button onclick="closeHeroModal(); openHeroSelectionModal();" class="select-hero-link">Choisir un personnage</button>';
    echo '</div>';
    exit;
}

$hero_id = $_SESSION['current_hero_id'];

$requeteHero = $db->prepare("
    SELECT 
        hero.id as hero_id,
        hero.name as nomHero, 
        hero.image, 
        hero.pv,
        hero.pv_max,
        hero.mana,
        hero.mana_max,
        hero.strength, 
        hero.xp, 
        hero.current_level,
        armor.name as nomArmure,
        armor.item_image as imageArmure,
        armor.bonus_defense as bonusDefenseArmure,
        primary_weapon.name as nomArmePrincipale,
        primary_weapon.item_image as imageArmePrincipale,
        primary_weapon.bonus_attaque as bonusAttaquePrimaire,
        secondary_weapon.name as nomArmeSecondaire,
        secondary_weapon.item_image as imageArmeSecondaire,
        secondary_weapon.bonus_attaque as bonusAttaqueSecondaire,
        shield.name as nomBouclier,
        shield.item_image as imageBouclier,
        shield.bonus_defense as bonusDefenseBouclier
    FROM Hero hero
    LEFT JOIN Items armor ON hero.armor_item_id = armor.id
    LEFT JOIN Items primary_weapon ON hero.primary_weapon_item_id = primary_weapon.id
    LEFT JOIN Items secondary_weapon ON hero.secondary_weapon_item_id = secondary_weapon.id
    LEFT JOIN Items shield ON hero.shield_item_id = shield.id
    WHERE hero.id = ?
");

$requeteHero->execute([$hero_id]);

if ($hero = $requeteHero->fetch(PDO::FETCH_ASSOC)) {
    // Bouton pour changer de personnage
    echo '<div class="change-hero-container">';
    echo '<button onclick="closeHeroModal(); openHeroSelectionModal();" class="change-hero-btn">Changer de personnage</button>';
    echo '</div>';
    
    // Affichage du héros
    echo '<div class="hero-card">';
    echo '<div class="hero-header">';
    echo '<img src="' . htmlspecialchars($hero['image']) . '" alt="Hero Image" class="hero-image">';
    
    // Container pour nom/niveau et statistiques
    echo '<div class="hero-info-container">';
    
    // Affichage nom et niveau
    echo '<div class="hero-info">';
    echo '<h1>' . htmlspecialchars($hero['nomHero']) . '</h1>';
    echo '<span class="level-badge">Niveau ' . htmlspecialchars($hero['current_level']) . '</span>';
    echo '</div>';
    
    // Affichage des statistiques avec PV/PV_max et Mana/Mana_max
    echo '<div class="hero-stats">';
    echo '<div class="stat-item">';
    echo '<span class="stat-label">PV:</span>';
    echo '<span class="stat-value">' . htmlspecialchars($hero['pv']) . ' / ' . htmlspecialchars($hero['pv_max']) . '</span>';
    echo '</div>';
    echo '<div class="stat-item">';
    echo '<span class="stat-label">Mana:</span>';
    echo '<span class="stat-value">' . htmlspecialchars($hero['mana']) . ' / ' . htmlspecialchars($hero['mana_max']) . '</span>';
    echo '</div>';
    echo '<div class="stat-item">';
    echo '<span class="stat-label">Force:</span>';
    echo '<span class="stat-value">' . htmlspecialchars($hero['strength']) . '</span>';
    echo '</div>';
    echo '<div class="stat-item">';
    echo '<span class="stat-label">XP:</span>';
    echo '<span class="stat-value">' . htmlspecialchars($hero['xp']) . '</span>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    // Affichage de l'équipement sur le hero
    echo '<div class="equips-grid">';
    
    // Armure
    echo '<div class="equip-item equip-armure">';
    echo '<div class="equip-label">Armure</div>';
    if ($hero['nomArmure']) {
        echo '<img src="' . htmlspecialchars($hero['imageArmure']) . '" alt="Armure" class="equip-image">';
        echo '<div class="equip-value">' . htmlspecialchars($hero['nomArmure']) . '</div>';
        echo '<button class="unequip-btn" onclick="unequipItem(\'armor_item_id\')">Déséquiper</button>';
    } else {
        echo '<div class="empty-slot">Aucune armure équipée</div>';
    }
    echo '</div>';
    
    // Arme principale
    echo '<div class="equip-item equip-armeP">';
    echo '<div class="equip-label">Arme principale</div>';
    if ($hero['nomArmePrincipale']) {
        echo '<img src="' . htmlspecialchars($hero['imageArmePrincipale']) . '" alt="Arme principale" class="equip-image">';
        echo '<div class="equip-value">' . htmlspecialchars($hero['nomArmePrincipale']) . '</div>';
        echo '<button class="unequip-btn" onclick="unequipItem(\'primary_weapon_item_id\')">Déséquiper</button>';
    } else {
        echo '<div class="empty-slot">Aucune arme principale équipée</div>';
    }
    echo '</div>';
    
    // Arme secondaire
    echo '<div class="equip-item equip-armeS">';
    echo '<div class="equip-label">Arme secondaire</div>';
    if ($hero['nomArmeSecondaire']) {
        echo '<img src="' . htmlspecialchars($hero['imageArmeSecondaire']) . '" alt="Arme secondaire" class="equip-image">';
        echo '<div class="equip-value">' . htmlspecialchars($hero['nomArmeSecondaire']) . '</div>';
        echo '<button class="unequip-btn" onclick="unequipItem(\'secondary_weapon_item_id\')">Déséquiper</button>';
    } else {
        echo '<div class="empty-slot">Aucune arme secondaire équipée</div>';
    }
    echo '</div>';
    
    // Bouclier
    echo '<div class="equip-item equip-bouclier">';
    echo '<div class="equip-label">Bouclier</div>';
    if ($hero['nomBouclier']) {
        echo '<img src="' . htmlspecialchars($hero['imageBouclier']) . '" alt="Bouclier" class="equip-image">';
        echo '<div class="equip-value">' . htmlspecialchars($hero['nomBouclier']) . '</div>';
        echo '<button class="unequip-btn" onclick="unequipItem(\'shield_item_id\')">Déséquiper</button>';
    } else {
        echo '<div class="empty-slot">Aucun bouclier équipé</div>';
    }
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
    
    // Affichage de l'inventaire - grille simple
    $requeteInventaire = $db->prepare("
        SELECT 
            item.id as item_id,
            item.name as nomItem,
            item.item_image as imageItem,
            item.description as descriItem, 
            item.item_type as typeItem,
            item.bonus_attaque,
            item.bonus_defense,
            item.bonus_pv,
            item.bonus_mana,
            inv.quantity
        FROM Inventory inv 
        JOIN Items item ON inv.item_id = item.id 
        WHERE inv.hero_id = ? AND inv.quantity > 0
        ORDER BY item.item_type, item.name
    ");
    $requeteInventaire->execute([$hero['hero_id']]);
    $items = $requeteInventaire->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<div class="inventory-section">';
    echo '<h2 class="inventory-title">Inventaire</h2>';
    echo '<div class="inventory-grid-simple">';
    
    // Nombre de cases d'inventaire
    $totalSlots = 26;
    
    // Afficher les items
    foreach ($items as $index => $row) {
        $itemId = $row['item_id'];
        $isNotEquippable = in_array($row['typeItem'], ['Potion']);
        $isEquippable = in_array($row['typeItem'], ['Armure', 'Arme', 'Bouclier']);
        
        echo '<div class="inventory-slot filled" data-item-id="' . $itemId . '">';
        echo '<img src="' . htmlspecialchars($row['imageItem']) . '" alt="' . htmlspecialchars($row['nomItem']) . '" class="item-image">';
        echo '<div class="item-quantity">×' . htmlspecialchars($row['quantity']) . '</div>';
        
        // Tooltip
        echo '<div class="item-tooltip">';
        echo '<div class="tooltip-name">' . htmlspecialchars($row['nomItem']) . '</div>';
        echo '<div class="tooltip-type">' . htmlspecialchars($row['typeItem']) . '</div>';
        echo '<div class="tooltip-description">' . htmlspecialchars($row['descriItem']) . '</div>';
        
        // Boutons d'action dans le tooltip
        echo '<div class="tooltip-actions">';
        if ($isEquippable) {
            echo '<button class="tooltip-btn equip-btn" onclick="equipItem(' . $itemId . ', event)">⚔ Équiper</button>';
        } if ($isNotEquippable) {
            echo '<button class="tooltip-btn use-btn" onclick="useItem(' . $itemId . ', event)">✨ Utiliser</button>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    // Remplir les cases vides restantes
    $emptySlots = $totalSlots - count($items);
    for ($i = 0; $i < $emptySlots; $i++) {
        echo '<div class="inventory-slot empty"></div>';
    }
    
    echo '</div>';
    echo '</div>';
} else {
    echo '<p class="error-message">Personnage introuvable.</p>';
}
?>