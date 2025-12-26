<?php
require_once("header.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - DungeonXplorer</title>
    <link rel="stylesheet" href="/DungeonXplorer/public/css/admin.css">
    <script src="/DungeonXplorer/public/js/admin.js" defer></script>
</head>
<body>
    <div class="admin-container">
        <h1>Panneau d'Administration</h1>
        
        <!-- TABS DE NAVIGATION -->
        <div class="admin-tabs">
            <button class="tab-btn active" onclick="switchTab('chapters')">Chapitres</button>
            <button class="tab-btn" onclick="switchTab('monsters')">Monstres</button>
            <button class="tab-btn" onclick="switchTab('treasures')">Trésors</button>
            <button class="tab-btn" onclick="switchTab('users')">Utilisateurs</button>
        </div>
        
        <!-- TAB: CHAPITRES -->
        <div id="tab-chapters" class="tab-content active">
            <div class="tab-header">
                <h2>Gestion des Chapitres</h2>
                <button class="btn-add" onclick="openModal('chapter')">+ Ajouter un chapitre</button>
            </div>
            <div id="chapters-list" class="content-list">
                <div class="loader"></div>
            </div>
        </div>
        
        <!-- TAB: MONSTRES -->
        <div id="tab-monsters" class="tab-content">
            <div class="tab-header">
                <h2>Gestion des Monstres</h2>
                <button class="btn-add" onclick="openModal('monster')">+ Ajouter un monstre</button>
            </div>
            <div id="monsters-list" class="content-list">
                <div class="loader"></div>
            </div>
        </div>
        
        <!-- TAB: TRÉSORS -->
        <div id="tab-treasures" class="tab-content">
            <div class="tab-header">
                <h2>Gestion des Trésors</h2>
                <button class="btn-add" onclick="openModal('treasure')">+ Ajouter un trésor</button>
            </div>
            <div id="treasures-list" class="content-list">
                <div class="loader"></div>
            </div>
        </div>
        
        <!-- TAB: UTILISATEURS -->
        <div id="tab-users" class="tab-content">
            <div class="tab-header">
                <h2>Gestion des Utilisateurs</h2>
            </div>
            <div id="users-list" class="content-list">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    
    <!-- MODAL POUR LES FORMULAIRES -->
    <div id="adminModal" class="admin-modal">
        <div class="modal-content-admin">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h3 id="modal-title">Formulaire</h3>
            <form id="adminForm" onsubmit="handleSubmit(event)">
                <div id="form-fields"></div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Enregistrer</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>