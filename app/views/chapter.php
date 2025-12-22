<?php
    require_once("header.php");
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/chapter.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Chapitre <?= htmlspecialchars($chapter['id'] ?? '0') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto&display=swap" rel="stylesheet">
    <script src="/DungeonXplorer/public/js/inventory.js" defer></script>
    <script src="/DungeonXplorer/public/js/heroselection.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Chapitre <?= htmlspecialchars($chapter['id'] ?? '?') ?></h1>

        <!-- Image avec gestion d'erreur -->
        <?php if (!empty($chapter['image'])): ?>
            <!-- On affiche l'URL qui pose problème dans le ALT pour debugger -->
            <img src="/DungeonXplorer/public/images/<?= htmlspecialchars($chapter['image']) ?>" 
                 alt="ERREUR : Impossible de charger l'image : <?= htmlspecialchars($chapter['image']) ?>" 
                 class="chapter-img"
                 onerror="this.style.display='none'; document.getElementById('debug-msg').style.display='block';">
            
            <div id="debug-msg" class="img-error">
                Image introuvable à cette adresse : <br>
                <strong><?= htmlspecialchars($chapter['image']) ?></strong>
            </div>
        <?php endif; ?>

        <div class="content-text">
            <?= nl2br(htmlspecialchars($chapter['content'] ?? 'Contenu introuvable.')) ?>
        </div>

        <hr style="border: 0; border-top: 1px solid #C4975E; margin: 30px 0;">

        <?php if (empty($choices)): ?>
            <p style="font-style:italic; color:#888;">L'aventure se termine ici...</p>
            <a href="/DungeonXplorer/" class="choice-btn">Retourner à l'accueil</a>
        <?php else: ?>
            <h3 style="font-family:'Pirata One'; color:#C4975E; font-size:2em;">Que faites-vous ?</h3>
            <?php foreach ($choices as $choice):?>
                <a href="/DungeonXplorer/chapitre/<?php echo $choice['chapter']; ?>" class="choice-btn">
                    <?= htmlspecialchars($choice['text']) ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
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

</body>
</html>