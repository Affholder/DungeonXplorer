<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/DungeonXplorer/public/css/hero.css">
    <title>Création de Personnage - DungeonXplorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <?php
    // Configuration des images (Mappage Nom de classe -> Fichier image)
    // Assurez-vous que ces fichiers existent dans votre dossier public/images/
    $classImages = [
        'Guerrier' => 'public/images/Berserker.jpg',
        'Mage'     => 'public/images/Wizard.jpg',
        'Voleur'   => 'public/images/Thief.jpg'
    ];
    ?>

    <h1>Nouvelle Aventure</h1>
    <p class="subtitle">Choisissez votre destinée pour entrer dans le Val Perdu</p>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-msg"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card-container">
        <?php foreach ($classes as $class): ?>
            <div class="card">
                <!-- Affichage de l'image -->
                <?php 
                    // On cherche l'image correspondante, sinon on met une image par défaut ou vide
                    $imgSrc = $classImages[$class['name']] ?? ''; 
                ?>
                <?php if($imgSrc): ?>
                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($class['name']) ?>" class="class-img">
                <?php else: ?>
                    <!-- Carré gris si pas d'image -->
                    <div style="width:100%; height:200px; background:#333; display:flex; align-items:center; justify-content:center; border-radius:5px; margin-bottom:15px;">
                        Pas d'image
                    </div>
                <?php endif; ?>

                <h2><?= htmlspecialchars($class['name']) ?></h2>
                <p><em><?= htmlspecialchars($class['description']) ?></em></p>
                
                <ul class="stats">
                    <li>❤️ PV : <?= $class['base_pv'] ?></li>
                    <li>✨ Mana : <?= $class['base_mana'] ?></li>
                    <li>⚔️ Force : <?= $class['strength'] ?></li>
                    <li>🎲 Initiative : <?= $class['initiative'] ?></li>
                </ul>
                
                <form method="POST" action="creationperso">
                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    <input type="text" name="hero_name" required placeholder="Nom du héros" autocomplete="off">
                    <button type="submit" class="btn">Incarner</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>