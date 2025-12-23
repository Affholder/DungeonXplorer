<?php
session_start();
require_once("header.php");


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: /DungeonXplorer/home");
    exit();
}

// Récupérer les informations de l'utilisateur
require_once __DIR__ . '/../models/user.php';
require __DIR__ . '/../../config/con_db.php';
$userModel = new User($db);
$user = $userModel->getUserById($_SESSION['user_id']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Dungeon Xplorer</title>
    <link rel="stylesheet" href="/DungeonXplorer/public/css/account.css">
    
</head>
<body>
    <div class="account-container">
        <div class="account-header">
            <h1>Mon Compte</h1>
            <p>Gérez vos informations personnelles</p>
        </div>

        <!-- Informations du compte -->
        <div class="account-info-card">
            <div class="info-section">
                <h2>📋 Informations personnelles</h2>
                <div class="info-row">
                    <span class="info-label">👤 Nom d'utilisateur :</span>
                    <span class="info-value"><?= htmlspecialchars($user['username']) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">📧 Email :</span>
                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>

            </div>
        </div>

        <!-- Zone de danger -->
        <div class="danger-zone">
            <h3>⚠️ Zone dangereuse</h3>
            
            <div class="danger-zone-warning">
                <strong>⚡ Attention !</strong> La suppression de votre compte est <strong>irréversible</strong> et entraînera :
                <ul>
                    <li>La suppression définitive de tous vos héros</li>
                    <li>La perte de tous vos progrès et inventaires</li>
                    <li>La suppression de votre historique de jeu</li>
                    <li>L'impossibilité de récupérer vos données</li>
                </ul>
            </div>
            
            <form method="POST" action="/DungeonXplorer/deleteAccount" 
                  onsubmit="return confirm('⚠️ DERNIÈRE CONFIRMATION !\n\nVous êtes sur le point de supprimer définitivement votre compte « <?= htmlspecialchars($user['username']) ?> »\n✗ Tous vos progrès seront perdus\n✗ Cette action est IRRÉVERSIBLE\n\nTapez OK pour confirmer la suppression');">
                <button type="submit" class="btn-danger">
                    🗑️ Supprimer définitivement mon compte
                </button>
            </form>
        </div>
    </div>
</body>
</html>