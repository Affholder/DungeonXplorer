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
        // Gérer l'upload de l'image si présente
        $imagePath = null;
        if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] === UPLOAD_ERR_OK) {
            
            // Vérifier le type de fichier
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType = $_FILES['hero_image']['type'];
            
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(['error' => 'Format d\'image non autorisé. Utilisez JPG, PNG, GIF ou WEBP.']);
                exit;
            }
            
            // Vérifier la taille (5MB max)
            if ($_FILES['hero_image']['size'] > 5 * 1024 * 1024) {
                echo json_encode(['error' => 'L\'image ne doit pas dépasser 5MB']);
                exit;
            }
            
            // Créer le dossier s'il n'existe pas
            $uploadDir = __DIR__ . '/../../public/images/heroes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Générer un nom unique pour l'image
            $extension = pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION);
            $fileName = 'hero_' . $hero_id . '_' . time() . '.' . $extension;
            $uploadPath = $uploadDir . $fileName;
            
            // Déplacer le fichier uploadé
            if (move_uploaded_file($_FILES['hero_image']['tmp_name'], $uploadPath)) {
                // Chemin relatif pour la base de données
                $imagePath = '/DungeonXplorer/public/images/heroes/' . $fileName;
                
                // Supprimer l'ancienne image si elle existe
                $stmt = $db->prepare("SELECT image FROM Hero WHERE id = ?");
                $stmt->execute([$hero_id]);
                $oldImage = $stmt->fetchColumn();
                
                if ($oldImage && file_exists(__DIR__ . '/../../' . str_replace('/DungeonXplorer/', '', $oldImage))) {
                    $oldImagePath = __DIR__ . '/../../' . str_replace('/DungeonXplorer/', '', $oldImage);
                    if (strpos($oldImage, 'heroes/hero_') !== false) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                echo json_encode(['error' => 'Erreur lors de l\'upload de l\'image']);
                exit;
            }
        }
        
        // Préparer la requête SQL
        if ($imagePath) {
            $sql = "UPDATE Hero SET name = :name, biography = :biography, image = :image WHERE id = :hero_id";
            $params = [
                'name' => $name,
                'biography' => $biography,
                'image' => $imagePath,
                'hero_id' => $hero_id
            ];
        } else {
            $sql = "UPDATE Hero SET name = :name, biography = :biography WHERE id = :hero_id";
            $params = [
                'name' => $name,
                'biography' => $biography,
                'hero_id' => $hero_id
            ];
        }
        
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
        <form class="profile-form" onsubmit="saveProfile(event)" enctype="multipart/form-data">
            <div class="profile-header">
                <div class="profile-image-container">
                    <img src="<?php echo htmlspecialchars($hero['image']); ?>" 
                         alt="<?php echo htmlspecialchars($hero['name']); ?>" 
                         class="profile-image"
                         id="profileImagePreview">
                    <div class="image-upload-overlay">
                        <label for="hero_image" class="image-upload-label">
                            <span class="upload-icon">📷</span>
                            <span>Changer la photo</span>
                        </label>
                        <input type="file" 
                               id="hero_image" 
                               name="hero_image" 
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               onchange="previewImage(event)"
                               style="display: none;">
                    </div>
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
        
        <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                // Vérifier la taille
                if (file.size > 5 * 1024 * 1024) {
                    alert('L\'image ne doit pas dépasser 5MB');
                    event.target.value = '';
                    return;
                }
                
                // Prévisualiser l'image
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
        </script>
        <?php
    } else {
        echo '<p class="error-message">Personnage introuvable.</p>';
    }
    
} catch (PDOException $e) {
    echo '<p class="error-message">Erreur : ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>