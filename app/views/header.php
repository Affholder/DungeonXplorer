<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/header.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/inventory.css">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/heroselection.css">
    <script src="/DungeonXplorer/public/js/inventory.js" defer></script>
    <script src="/DungeonXplorer/public/js/heroselection.js" defer></script>
</head>

<body>
    <header class="navbar">
        <ul class="nav-list">
            <li class="nav-item left">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer'">Home</button>
            </li>
            <?php
            if (isset($_SESSION['current_hero_id'])): ?>
                <li class="nav-item">
                    <button class="nav-button" onclick="openHeroModal()">Inventaire</button>
                </li>
            <?php endif;
            if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
                <button class="nav-button" onclick="openHeroSelectionModal()">Continuer l'aventure</button>
            </li>
            <li class="nav-item">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer/newgame'">Débuter une nouvelle aventure</button>
            </li>
            
            <li class="nav-item right">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer/deconnexion'">Déconnexion</button>
            </li>
            <?php endif; 
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