<?php
session_start();

require_once("header.php");
?>


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="public/js/homeLoginSignin.js"></script>
    <link rel="icon" type="image/png" href="public/images/favicon.jpg">
    <title>DungeonXplorer</title>
</head>

<body>
    <?php
        if (isset($_GET['message']) && $_GET['message'] === 'account_deleted') {
            echo '<div class="alert-success">✓ Compte supprimé avec succès</div>';
        }

        if (isset($_GET['error']) && $_GET['error'] === 'delete_failed') {
            echo '<div class="alert-error">✗ Erreur lors de la suppression</div>';
        }
    ?>

    <h1>Bienvenue sur DungeonXplorer !</h1>
    <div class="edito">
        <p>Bienvenue sur DungeonXplorer, l'univers de dark fantasy où se mêlent aventure, stratégie et immersion
totale dans les récits interactifs.</p>
        <p>Ce projet est né de la volonté de l’association Les Aventuriers du Val Perdu de raviver l’expérience unique
des livres dont vous êtes le héros. Notre vision : offrir à la communauté un espace où chacun peut
incarner un personnage et plonger dans des quêtes épiques et personnalisées.</p>
        <p>Dans sa première version, DungeonXplorer permettra aux joueurs de créer un personnage parmi trois
classes emblématiques — guerrier, voleur, magicien — et d’évoluer dans un scénario captivant, tout en
assurant à chacun la possibilité de conserver sa progression.</p>
        <p>Nous sommes enthousiastes de partager avec vous cette application et espérons qu'elle saura vous
plonger au cœur des mystères du Val Perdu !</p>
    </div>


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
    
        <div class="overlay" id="login-popup">
            <div class="content">
                <h2>Connecte-toi pour jouer !</h2>
                <span class="close" onclick="closePopUp()">&times;</span>
                <form id="form_login" action="connexion" method="POST">
                    <input type="hidden" name="route" value="connexion">
                    <label for="username">Nom d'utilisateur : </label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Mot de passe : </label>
                    <input type="password" id="password" name="password" required>


                    <!-- Affichage des erreurs -->
                    <?php if (isset($_SESSION['error']) && $_SESSION['modal'] == "login"): ?>
                        <p style="color:red;"><?php echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                                unset($_SESSION['modal']); ?></p>
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
                <span class="close" onclick="closePopUp()">&times;</span>
                <form id="form_signup" action="inscription" method="POST">
                    <input type="hidden" name="route" value="inscription">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="username">Nom d'utilisateur : </label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Mot de passe : </label>
                    <div class="password-requirements-tooltip" id="password-requirements-tooltip">
                        <p>Votre mot de passe doit contenir</p>
                        <ul>
                            <li>Au moins 8 caractères</li>
                            <li>Au moins une minuscule</li>
                            <li>Au moins une majuscule</li>
                            <li>Au moins un chiffre</li>
                            <li>Au moins un caractère spécial parmi "@$!%*?&#^()_+-=[]{};:,.<>"</li>
                        </ul>
                    </div>
                    <input type="password" id="password" name="password" required>

                    <label for="password-confirm">Confirmer le mot de passe :</label>
                    <input type="password" id="password-confirm" name="password-confirm" required>

                    <!-- Affichage des erreurs -->
                    <?php if (isset($_SESSION['error']) && $_SESSION['modal'] == "signin"): ?>
                        <p style="color:red;"><?php echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                                unset($_SESSION['modal']); ?></p>
                    <?php
                    endif;
                    ?>

                    <button type="submit">Inscription</button>
                    <button type="button" onclick="openLogInPopUp()">J'ai déjà un compte</button>
                </form>
            </div>
        </div>
    

    <!-- Modal Sélection de Héros -->
    <div id="heroSelectionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Choisissez votre personnage</h2>
                <span class="close" onclick="closeHeroSelectionModal()">&times;</span>
            </div>
            <div class="modal-body" id="heroSelectionContent">
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <!-- Modal Inventaire -->
    <div id="heroModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Inventaire</h2>
                <span class="close" onclick="closeHeroModal()">&times;</span>
            </div>
            <div class="modal-body" id="heroContent">
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <!-- Boutons "Nouvelle Partie" et "Déconnexion" -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div id="newgame-btn-div">
            <button id="newGame-btn" onclick="window.location.href='/DungeonXplorer/newgame'" class="option-btn">Nouvelle Partie</button>
        </div>
        <div id="disconnect-btn-div">
            <button id="disconnect-btn" <?php if (!isset($_SESSION['current_hero_id'])): ?>onclick="openHeroSelectionModal()"<?php else: ?> onclick="window.location.href='/DungeonXplorer/load'" <?php endif; ?> class="option-btn">Continuer mon aventure</button>
        </div>
    <?php endif; ?>

</body>
<script src="public/js/inventory.js"></script>
<script src="public/js/heroselection.js"></script>

</html>