<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création de Personnage - DungeonXplorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto&display=swap" rel="stylesheet">
    
    <style>
        body { 
            background-color: #1A1A1A; 
            color: #E5E5E5; 
            font-family: 'Roboto', sans-serif; 
            text-align: center; 
            margin: 0;
            padding: 20px;
        }
        h1 { 
            font-family: 'Pirata One', cursive; 
            color: #C4975E; 
            font-size: 3em;
            margin-bottom: 10px;
        }
        p.subtitle {
            font-size: 1.2em;
            margin-bottom: 40px;
        }
        
        .card-container { 
            display: flex; 
            justify-content: center; 
            gap: 30px; 
            flex-wrap: wrap; 
        }
        
        .card { 
            background-color: #2E2E2E; 
            border: 2px solid #4A7A66; 
            border-radius: 10px; 
            padding: 20px; 
            width: 300px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: #C4975E;
        }
        
        /* Style pour l'image de classe */
        .class-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #444;
        }

        .card h2 {
            font-family: 'Pirata One', cursive;
            color: #C4975E;
            font-size: 2em;
            margin: 10px 0;
        }
        
        .stats {
            text-align: left;
            background: rgba(0,0,0,0.3);
            padding: 10px;
            border-radius: 5px;
            list-style: none;
            padding-left: 10px;
            width: 90%;
            margin-bottom: 15px;
        }
        .stats li { margin: 5px 0; }
        
        input[type="text"] { 
            width: 80%;
            padding: 10px; 
            margin-bottom: 10px;
            border-radius: 5px; 
            border: 1px solid #C4975E; 
            background: #1A1A1A; 
            color: white; 
            text-align: center;
        }
        
        button.btn { 
            width: 100%;
            background-color: #C4975E; 
            color: #1A1A1A; 
            padding: 12px; 
            border: none; 
            font-family: 'Pirata One'; 
            font-size: 1.4em; 
            cursor: pointer; 
            border-radius: 5px;
            transition: background 0.3s;
        }
        button.btn:hover { 
            background-color: #8B1E1E; 
            color: white; 
        }
        .error-msg { color: #ff6b6b; font-weight: bold; margin-bottom: 20px; }
    </style>
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