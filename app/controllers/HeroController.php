<?php


class HeroController {

    // 1. AFFICHER LA PAGE DE CHOIX
    public function index() {
   
        // On vérifie la session
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/con_db.php';
        // On récupère les classes disponibles
        try {
            $stmt = $db->query("SELECT * FROM Class");
            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // On charge la vue (le fichier HTML)
            require 'app/views/hero.php';
            
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }
    }

    // 2. TRAITER LE FORMULAIRE ET CRÉER LE HÉROS
    public function create() {
        require_once __DIR__ . '/../../config/con_db.php';
        
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $classId = $_POST['class_id'] ?? null;
            $heroName = $_POST['hero_name'] ?? 'Aventurier sans nom'; // On récupère le nom

            if (!$classId) {
                $_SESSION['error'] = "Aucune classe sélectionnée";
                header('Location: /DungeonXplorer/chapitre/1');
                exit();
            }

            try {
                //Récupérer les stats de la classe choisie
                $stmt = $db->prepare("SELECT * FROM Class WHERE id = :id");
                $stmt->execute(['id' => $classId]);
                $classStats = $stmt->fetch(PDO::FETCH_ASSOC);

                //Récuperer l'id de l'utilisateur
                if (isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
                }
                else{
                    $_SESSION['error'] = "Erreur : l'utilisateur n'est pas connecté.";
                    header('Location: /DungeonXplorer');
                    exit();
                }

                if ($classStats) {
                    //Insérer le héros
                    $sql = "INSERT INTO Hero (name, class_id, pv, pv_max, mana, mana_max, strength, initiative, xp, user_id) 
                            VALUES (:name, :cid, :pv, :pv, :mana, :mana, :str, :init, 0, :userid)";
                    
                    $insert = $db->prepare($sql);
                    $insert->execute([
                        'name' => $heroName,
                        'cid'  => $classId,
                        'pv'   => $classStats['base_pv'],
                        'mana' => $classStats['base_mana'],
                        'str'  => $classStats['strength'],
                        'init' => $classStats['initiative'],
                        'userid' => $user_id
                    ]);

                    //REDIRIGER VERS LE JEU
                    //$_SESSION['hero_id'] = $db->lastInsertId();

                    //Redirection vers le Chapitre 1
                    header('Location: /DungeonXplorer/chapitre/1');
                    exit();
                }

            } catch (PDOException $e) {
                $_SESSION['error'] = "Erreur : " . $e->getMessage();
                header('Location: /DungeonXplorer/newgame');
                exit();
            }
        }
        
        // Si on arrive ici par erreur, retour au formulaire
        header('Location: /DungeonXplorer/newgame');
        exit();
    }
}
?>