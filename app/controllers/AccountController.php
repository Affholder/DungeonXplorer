<?php
require_once __DIR__ . '/../models/user.php';

class AccountController {

    public function index() {
        require_once 'app/views/account.php';
    }
    
    public function deleteAccount() {
        session_start();
        require __DIR__ . '/../../config/con_db.php';

        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: /DungeonXplorer/home");
            exit();
        }
        
        // Vérifier que c'est bien une requête POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /DungeonXplorer/home");
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        
        try {
            $userModel = new User($db);
            $result = $userModel->deleteUser($userId);
            
            if ($result) {
                // Détruire la session
                $_SESSION = array();
                session_destroy();
                
                // Rediriger vers l'accueil avec un message
                header("Location: /DungeonXplorer/home?message=account_deleted");
                exit();
            } else {
                header("Location: /DungeonXplorer/home?error=delete_failed");
                exit();
            }
        } catch (Exception $e) {
            error_log("Erreur suppression compte: " . $e->getMessage());
            header("Location: /DungeonXplorer/home?error=delete_failed");
            exit();
        }
    }
}
?>