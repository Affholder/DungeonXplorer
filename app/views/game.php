<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Aventure</title>
    </head>
<body style="background-color: #1A1A1A; color: #E5E5E5; font-family: sans-serif;">

    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        
        <?php if (!empty($chapterData['image'])): ?>
            <img src="<?= htmlspecialchars($chapterData['image']) ?>" alt="Scene" style="width:100%; max-height:400px; object-fit:cover;">
        <?php endif; ?>

        <h1>Chapitre <?= $chapterData['id'] ?></h1>
        <p style="font-size: 1.2em; line-height: 1.6;">
            <?= nl2br(htmlspecialchars($chapterData['content'])) ?>
        </p>

        <hr style="border-color: #C4975E;">

        <h3>Que voulez-vous faire ?</h3>
        
        <?php if (empty($choices)): ?>
            <p><em>Fin de l'aventure...</em></p>
            <a href="/DungeonXplorer" style="color: #C4975E;">Retour à l'accueil</a>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <?php foreach ($choices as $choice): ?>
                    <a href="/DungeonXplorer/chapitre/<?= $choice['chapter']?>" 
                       style="background-color: #C4975E; color: #1A1A1A; padding: 10px; text-decoration: none; text-align: center; border-radius: 5px; font-weight: bold;">
                        <?= htmlspecialchars($choice['text']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>