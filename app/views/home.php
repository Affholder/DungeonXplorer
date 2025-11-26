<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="public/js/homeLoginSignin.js"></script>
    <title>DungeonXplorer</title>

</head>
<body>
    <h1>Bienvenue sur DungeonXplorer !</h1>
    <?php if (!$isLoggedIn): ?>
    <div class="overlay" id="login-popup">
        <div class="content">
            <h2>Connecte toi pour jouer !</h2>
            <form id="form_login" action="connexion" method="POST">
                <input type="hidden" name="route" value="connexion">
                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username">

                <label for="password">Mot de passe : </label>
                <input type="password" id="password" name="password">

                <button type="submit">Connexion</button>
                <button onclick="openSignInPopUp()" type="button">Je n'ai pas de compte</button>
            </form>
        </div>
    </div>

    <div class="overlay" id="signin-popup">
        <div class="content">
            <h2>Créer un compte</h2>
            <form id="form_login" action="inscription" method="POST">
                <input type="hidden" name="route" value="inscription">
                <label for="email">Email</label>

                <input type="email" id="email" name="email">

                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username">

                <label for="password">Mot de passe : </label>
                <input type="password" id="password" name="password">

                <label for="password-confirm">Confirmer le mot de passe :</label>
                <input type="password" id="password-confirm" name="password-confirm">

                <button type="submit">Inscription</button>
                <button onclick="openLogInPopUp()" type="button">J'ai déja un compte</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <div id= "newgame-btn-div">
        <button id="newGame-btn" onclick="window.location.href='/DungeonXplorer/newgame'" class="option-btn">Nouvelle Partie</button>
    </div>
    <div id= "disconnect-btn-div">
        <button id="disconnect-btn" onclick="window.location.href='/DungeonXplorer/deconnexion'" class="option-btn">Se deconnecter</button>
    </div>


</body>
</html>