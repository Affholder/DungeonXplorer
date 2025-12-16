<?php
session_start();

require_once("header.php");
?>


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="public/js/homeLoginSignin.js"></script>
    <title>DungeonXplorer</title>
</head>
<body>
    <h1>Bienvenue sur DungeonXplorer !</h1>

    <!-- Script pour ouvrir la bonne modale selon la session -->
    <script>
    <?php
    // Si une modale doit être ouverte
    if (isset($_SESSION['modal'])) {
        if ($_SESSION['modal'] == "login") {
            echo "document.addEventListener('DOMContentLoaded', function() { openLogInPopUp(); });";
        } elseif ($_SESSION['modal'] == "signin") {
            echo "document.addEventListener('DOMContentLoaded', function() { openSignInPopUp(); });";
        }
    }
    ?>
    </script>


    <!-- Pop-up Login -->
    <?php if (!isset($_SESSION['user_id'])): ?>
    <div class="overlay" id="login-popup">
        <div class="content">
            <h2>Connecte-toi pour jouer !</h2>
            <form id="form_login" action="connexion" method="POST">
                <input type="hidden" name="route" value="connexion">
                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe : </label>
                <input type="password" id="password" name="password" required>


                <!-- Affichage des erreurs -->
                <?php if (isset($_SESSION['error'])&& $_SESSION['modal'] == "login"): ?>
                    <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); unset($_SESSION['modal']);?></p>  
                <?php
                endif;
                 ?>

                <button type="submit">Connexion</button>
                <button type="button" onclick="openSignInPopUp()">Je n'ai pas de compte</button>
            </form>
        </div>
    </div>

    <!-- Pop-up SignIn -->
    <div class="overlay" id="signin-popup">
        <div class="content">
            <h2>Créer un compte</h2>
            <form id="form_signup" action="inscription" method="POST">
                <input type="hidden" name="route" value="inscription">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="username">Nom d'utilisateur : </label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe : </label>
                <input type="password" id="password" name="password" required>

                <label for="password-confirm">Confirmer le mot de passe :</label>
                <input type="password" id="password-confirm" name="password-confirm" required>

                <!-- Affichage des erreurs -->
                <?php if (isset($_SESSION['error']) && $_SESSION['modal'] == "signin"): ?>
                    <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); unset($_SESSION['modal']);?></p>  
                <?php
                endif;
                 ?>

                <button type="submit">Inscription</button>
                <button type="button" onclick="openLogInPopUp()">J'ai déjà un compte</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Boutons "Nouvelle Partie" et "Déconnexion" -->
    <?php if (isset($_SESSION['user_id'])): ?>
    <div id="newgame-btn-div">
        <button id="newGame-btn" onclick="window.location.href='/DungeonXplorer/newgame'" class="option-btn">Nouvelle Partie</button>
    </div>

    <div id="disconnect-btn-div">
        <button id="disconnect-btn" onclick="window.location.href='/DungeonXplorer/deconnexion'" class="option-btn">Se déconnecter</button>
    </div>
    <?php endif; ?>

</body>
</html>