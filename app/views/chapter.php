<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Chapitre <?= htmlspecialchars($chapter['id'] ?? '0') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #1A1A1A;
            color: #E5E5E5;
            font-family: 'Roboto', sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background-color: #2E2E2E;
            padding: 40px;
            border-radius: 12px;
            border: 2px solid #C4975E;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        h1 {
            font-family: 'Pirata One', cursive;
            color: #C4975E;
            font-size: 3.5em;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .chapter-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid #444;
            margin-bottom: 25px;
            min-height: 200px; 
            background-color: #000;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .content-text {
            font-size: 1.3em; 
            text-align: justify; 
            line-height: 1.6;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .choice-btn {
            display: block;
            background-color: #C4975E;
            color: #1A1A1A;
            padding: 15px 20px;
            text-decoration: none;
            font-family: 'Pirata One', cursive;
            font-size: 1.5em;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.2s ease;
        }

        .choice-btn:hover {
            background-color: #8B1E1E;
            color: white;
            transform: translateY(-2px);
        }
        
        .img-error {
            color: #ff6b6b;
            font-size: 0.9em;
            margin-bottom: 10px;
            border: 1px dashed #ff6b6b;
            padding: 5px;
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Chapitre <?= htmlspecialchars($chapter['id'] ?? '?') ?></h1>

        <!-- Image avec gestion d'erreur -->
        <?php if (!empty($chapter['image'])): ?>
            <!-- On affiche l'URL qui pose problème dans le ALT pour debugger -->
            <img src="public/images/<?= htmlspecialchars($chapter['image']) ?>" 
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
            <a href="DungeonXplorer/" class="choice-btn">Retourner à l'accueil</a>
        <?php else: ?>
            <h3 style="font-family:'Pirata One'; color:#C4975E; font-size:2em;">Que faites-vous ?</h3>
            <?php foreach ($choices as $choice):?>
                <a href="<?php echo $choice['chapter']; ?>" class="choice-btn">
                    <?= htmlspecialchars($choice['text']) ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>