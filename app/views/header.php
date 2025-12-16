<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/header.css">

</head>
<body>
    <header class="navbar">
        <ul class="nav-list">
            <li class="nav-item left">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer'">Home</button>
            </li>
            <li class="nav-item">
                <button class="nav-button">Inventaire</button>
            </li>
            <li class="nav-item">
                <button class="nav-button">Continuer l'aventure</button>
            </li>
            <li class="nav-item">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer/newgame'" >Débuter une nouvelle aventure</button>
            </li>
            <li class="nav-item right">
                <button class="nav-button" onclick="window.location.href='/DungeonXplorer/deconnexion'">Déconnexion</button>
            </li>
        </ul>
    </header>
