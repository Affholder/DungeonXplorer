<?php
require_once __DIR__ . '/../../config/con_db.php';
session_start();

// Vérifier que l'utilisateur a sélectionné un héros
if (!isset($_SESSION['current_hero_id'])) {
    echo json_encode(['error' => 'Aucun personnage sélectionné']);
    exit;
}

$hero_id = $_SESSION['current_hero_id'];

// Si c'est une requête POST, on met à jour le profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['hero_name'] ?? '';
    $biography = $_POST['biography'] ?? '';
    
    // Validation
    if (empty($name)) {
        echo json_encode(['error' => 'Le nom ne peut pas être vide']);
        exit;
    }
    
    try {
        $sql = "UPDATE Hero SET name = :name, biography = :biography WHERE id = :hero_id";
        $params = [
            'name' => $name,
            'biography' => $biography,
            'hero_id' => $hero_id
        ];
        
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        
        echo json_encode(['success' => true]);
        exit;
        
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur lors de la mise à jour: ' . $e->getMessage()]);
        exit;
    }
}

// Sinon, on affiche le formulaire de profil
try {
    $stmt = $db->prepare("
        SELECT 
            hero.id,
            hero.name,
            hero.image,
            hero.biography,
            hero.current_level,
            hero.xp,
            class.name as class_name
        FROM Hero hero
        LEFT JOIN Class class ON hero.class_id = class.id
        WHERE hero.id = ?
    ");
    $stmt->execute([$hero_id]);
    $hero = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($hero) {
        ?>
        <form class="profile-form" onsubmit="saveProfile(event)">
            <div class="profile-header">
                <div class="profile-image-container">
                    <img src="<?php echo htmlspecialchars($hero['image']); ?>" 
                         alt="<?php echo htmlspecialchars($hero['name']); ?>" 
                         class="profile-image">
                </div>
                <div class="hero-class-level">
                    <p class="hero-class-name">
                        <?php echo htmlspecialchars($hero['class_name']); ?>
                    </p>
                    <p class="hero-level-text">
                        Niveau <?php echo htmlspecialchars($hero['current_level']); ?>
                    </p>
                    <p class="hero-xp-text">
                        XP: <?php echo htmlspecialchars($hero['xp']); ?>
                    </p>
                </div>
            </div>
            
            <div class="form-group">
                <label for="hero_name">Nom du personnage</label>
                <input type="text" 
                       id="hero_name" 
                       name="hero_name" 
                       value="<?php echo htmlspecialchars($hero['name']); ?>" 
                       required
                       maxlength="50">
            </div>
            
            <div class="form-group">
                <label for="biography">Biographie</label>
                <textarea id="biography" 
                          name="biography" 
                          rows="6"
                          placeholder="Racontez l'histoire de votre personnage, ses motivations, son passé..."><?php echo htmlspecialchars($hero['biography'] ?? ''); ?></textarea>
            </div>
            
            <button type="submit" class="btn-save">
                Sauvegarder les modifications
            </button>
        </form>
        <?php
    } else {
        echo '<p class="error-message">Personnage introuvable.</p>';
    }
    
} catch (PDOException $e) {
    echo '<p class="error-message">Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>