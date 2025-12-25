<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/header.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/inventory.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/heroselection.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/heromenu.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/profile.css">
    
    <script src="/DungeonXplorer/public/js/inventory.js" defer></script>
    <script src="/DungeonXplorer/public/js/heroselection.js" defer></script>
    <script src="/DungeonXplorer/public/js/heromenu.js" defer></script>
</head>

<body>
    
    <?php
    $isAdmin = false;
    if (isset($_SESSION['user_id'])) {
        // Vérifier si $db n'est pas déjà défini
        if (!isset($db)) {
            require_once __DIR__ . '/../../config/con_db.php';
        }
        
        $stmt = $db->prepare("SELECT admin FROM Game_User WHERE User_ID = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $userAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
        $isAdmin = ($userAdmin && $userAdmin['admin'] == 1);
    }
    ?>
    
    <header class="navbar">
        <ul class="nav-list">
            <li class="nav-item left">
                <button class="button-img" onclick="window.location.href='/DungeonXplorer'">
                    <img src="/DungeonXplorer/public/images/Logo.png" alt="logo" class="logo-img">
                </button>
            </li>
            <?php
            // Condition 1 : Héros sélectionné
            if (isset($_SESSION['current_hero_id'])): ?>
                <li class="nav-item">
                    <button class="nav-button" onclick="openHeroModal()">Inventaire</button>
                </li>
            <?php endif;
            
            // Condition 2 : Utilisateur connecté
            if (isset($_SESSION['user_id'])): ?>
            
                    <li class="nav-item">
                    <button class="nav-button" <?php if (!isset($_SESSION['current_hero_id'])): ?>onclick="openHeroSelectionModal()"<?php else: ?> onclick="window.location.href='/DungeonXplorer/load'" <?php endif; ?>>                        Continuer l'aventure
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-button" onclick="window.location.href='/DungeonXplorer/newgame'">Débuter une nouvelle aventure</button>
                    </li>
                    <?php if ($isAdmin): ?>
                        <li class="nav-item">
                            <button class="nav-button admin-button" onclick="window.location.href='/DungeonXplorer/admin'">
                            Administration
                            </button>
                        </li>
                    <?php endif; ?>
                
                <!-- Avatar du personnage si un héros est sélectionné -->
            <?php if (isset($_SESSION['current_hero_id'])): 
                // Vérifier si $db n'est pas déjà défini
                if (!isset($db)) {
                    require_once __DIR__ . '/../../config/con_db.php';
                }
                
                $stmt = $db->prepare("SELECT name, image FROM Hero WHERE id = ?");
                $stmt->execute([$_SESSION['current_hero_id']]);
                $currentHero = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($currentHero):
                    $heroImage = $currentHero['image'];
            ?>
            <li class="nav-item right">
                <div class="hero-avatar-container" onclick="toggleHeroMenu()">
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" 
                         alt="<?php echo htmlspecialchars($currentHero['name']); ?>" 
                         class="hero-avatar">
                    <div class="hero-avatar-name"><?php echo htmlspecialchars($currentHero['name']); ?></div>
                </div>
                
                <!-- Menu déroulant -->
                <div id="heroMenu" class="hero-menu">
                    <button class="hero-menu-btn" onclick="openProfileModal()">
                        <span class="menu-icon">👤</span> Modifier profil
                    </button>
                    
                    <button class="hero-menu-btn" onclick="openHeroSelectionModal()">
                        <span class="menu-icon">🔄</span> Changer de personnage
                    </button>
                    
                    <button class="hero-menu-btn" onclick="openHeroModal()">
                        <span class="menu-icon">👜</span> Consulter l'inventaire
                    </button>
                </div>
            </li>
            <?php endif; endif; ?>
                
                <li class="nav-item right">
                    <button class="nav-button" onclick="window.location.href='/DungeonXplorer/deconnexion'">Déconnexion</button>
                </li>

                <li class="nav-item right">
                    <button class="nav-button" onclick="window.location.href='/DungeonXplorer/account'">Mon compte</button>
                </li>

            <?php endif; // Fin Condition 2 (Utilisateur connecté)

            // Condition 4 : Utilisateur non connecté
            if (!isset($_SESSION['user_id'])): ?>
            <li class="nav-item right">
                <button class="nav-button" onclick="openSignInPopUp()">Inscription</button>
            </li>
            <li class="nav-item">
                <button class="nav-button" onclick="openLogInPopUp()">Connexion</button>
            </li>
            <?php endif;?>
        </ul>
    </header>
    
    <div id="profileModal" class="modal">
        <div class="modal-content" id="profileModalContent">
            <span class="close-modal" onclick="closeProfileModal()">&times;</span>
            <div class="modal-body" id="profileContent">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    
    <div id="changeHeroModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeHeroSelectionModal()">&times;</span>
            <div class="modal-header">
                <h2 class="modal-title">Changer de personnage</h2>
            </div>
            <div class="modal-body" id="changeHeroContent">
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <div id="heroModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeHeroModal()">&times;</span>
                <h2 class="modal-title">Mon Héros</h2>
            </div>
            <div id="heroContent" class="modal-body"></div>
        </div>
    </div>
    
    <div id="notification" class="notification"></div>

    <div id="heroSelectionModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeHeroSelectionModal()">&times;</span>
        <div class="modal-header">
            <h2 class="modal-title">Sélectionner un personnage</h2>
        </div>
        <div class="modal-body" id="heroSelectionContent">
            <div class="loader"></div>
        </div>
    </div>
</div>