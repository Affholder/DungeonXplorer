<?php
require_once __DIR__ . '/../../config/con_db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Non connecté']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupérer tous les héros de l'utilisateur
$requete = $db->prepare("
    SELECT 
        hero.id,
        hero.name,
        hero.image,
        hero.current_level,
        hero.pv,
        hero.mana,
        hero.strength,
        class.name as class_name
    FROM Hero hero
    LEFT JOIN Class class ON hero.class_id = class.id
    WHERE hero.user_id = ?
    ORDER BY hero.id DESC
");

$requete->execute([$user_id]);
$heroes = $requete->fetchAll(PDO::FETCH_ASSOC);

// Si c'est une requête pour sélectionner un héros
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hero_id'])) {
    $hero_id = intval($_POST['hero_id']);
    
    // Vérifier que le héros appartient bien à l'utilisateur
    $verif = $db->prepare("SELECT id FROM Hero WHERE id = ? AND user_id = ?");
    $verif->execute([$hero_id, $user_id]);
    
    if ($verif->fetch()) {
        $_SESSION['current_hero_id'] = $hero_id;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Héros invalide']);
    }
    exit;
}

// Sinon, afficher la liste des héros
if (empty($heroes)) {
    echo '<div class="no-heroes">';
    echo '<p>Vous n\'avez pas encore de personnage.</p>';
    echo '<button onclick="window.location.href=\'/DungeonXplorer/newgame\'" class="create-hero-btn">Créer votre premier héros</button>';
    echo '</div>';
} else {
    echo '<div class="heroes-grid">';
    foreach ($heroes as $hero) {
        $isCurrentHero = isset($_SESSION['current_hero_id']) && $_SESSION['current_hero_id'] == $hero['id'];
        $currentClass = $isCurrentHero ? ' current-hero' : '';
        
        echo '<div class="hero-selection-card' . $currentClass . '">';
        
        if ($isCurrentHero) {
            echo '<div class="current-badge">Personnage actuel</div>';
        }
        
        echo '<img src="' . htmlspecialchars($hero['image']) . '" alt="' . htmlspecialchars($hero['name']) . '" class="hero-selection-image">';
        echo '<div class="hero-selection-info">';
        echo '<h3>' . htmlspecialchars($hero['name']) . '</h3>';
        echo '<p class="hero-class">' . htmlspecialchars($hero['class_name'] ?? 'Aventurier') . '</p>';
        echo '<p class="hero-level">Niveau ' . htmlspecialchars($hero['current_level']) . '</p>';
        echo '<div class="hero-stats-mini">';
        echo '<span>PV: ' . htmlspecialchars($hero['pv']) . '</span>';
        echo '<span>Mana: ' . htmlspecialchars($hero['mana']) . '</span>';
        echo '<span>Force: ' . htmlspecialchars($hero['strength']) . '</span>';
        echo '</div>';

        if (!$isCurrentHero && isset($_SESSION['current_hero_id'])) {
            echo '<button class="select-hero-btn" data-hero-id="' . htmlspecialchars($hero['id']) . '">Sélectionner</button>';
        }
        if (!isset($_SESSION['current_hero_id'])) {
            echo '<button class="select-hero-btn redirect" data-hero-id="' . htmlspecialchars($hero['id']) . '">Continuer l\'aventure avec ce héros</button>';
        }
        
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
?>