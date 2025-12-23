<?php
require_once("header.php");
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/chapter.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Chapitre <?= htmlspecialchars($chapter['id'] ?? '0') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h1>Chapitre <?= htmlspecialchars($chapter['id'] ?? '?') ?></h1>

        <?php if (!empty($chapter['image'])): ?>
            <img src="/DungeonXplorer/public/images/<?= htmlspecialchars($chapter['image']) ?>" 
                 alt="Illustration du chapitre" 
                 class="chapter-img"
                 onerror="this.style.display='none';">
        <?php endif; ?>

        <div class="content-text">
            <?= nl2br(htmlspecialchars($chapter['content'] ?? 'Contenu introuvable.')) ?>
        </div>

        <hr style="border: 0; border-top: 1px solid #C4975E; margin: 30px 0;">

        <?php if (!empty($encounter)): ?>
            
            <div style="text-align: center; margin-top: 20px;">
                <h3 style="font-family:'Pirata One'; color:#e74c3c; font-size:2.5em; text-shadow: 0 0 5px black;">
                    ⚠️ EN GARDE !
                </h3>
                <p style="margin-bottom: 20px; font-style: italic;">Un ennemi vous barre la route...</p>
                
                <a href="/DungeonXplorer/combat" class="choice-btn" style="background-color: #8B1E1E; border: 2px solid #e74c3c; color: white;">
                    ⚔️ LANCER LE COMBAT ⚔️
                </a>
            </div>

        <?php elseif (empty($choices)): ?>
            
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

</body>
</html>