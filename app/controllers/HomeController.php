<?php
class HomeController {

    public function index() {
        require_once 'app/views/home.php';
    }

    public function inscription() {
        session_start();
        $error = "";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../models/user.php';
            require_once __DIR__ . '/../../config/con_db.php';

            $userModel = new User($db);
            
            // Validation de l'email
            if (isset($_POST["email"])) {
                $email = strip_tags($_POST["email"]);
                
                if (!$userModel->validateEmail($email)) {
                    $error = "Format d'email invalide.";
                } else if ($userModel->emailExists($email)) {
                    $error = "Un compte est déjà associé à cet email.";
                }
            } else {
                $error = "Email manquant.";
            }
    
            // Validation du nom d'utilisateur
            if ($error == "" && isset($_POST["username"])) {
                $username = strip_tags($_POST["username"]);
                if ($userModel->usernameExists($username)) {
                    $error = "Ce nom d'utilisateur est déjà pris.";
                }
            } else if ($error == "") {
                $error = "Nom d'utilisateur manquant.";
            }
    
            // Validation du mot de passe
            if ($error == "" && isset($_POST["password"]) && isset($_POST["password-confirm"])) {
                if ($_POST["password"] != $_POST["password-confirm"]) {
                    $error = "Les mots de passe ne correspondent pas.";
                } else {
                    $password = strip_tags($_POST["password"]);
                    
                    if (!$userModel->validatePassword($password)) {
                        $error = "Le mot de passe doit contenir au moins 8 caractères, incluant une minuscule, une majuscule, un chiffre et un caractère spécial.";
                    } else {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    }
                }
            } else if ($error == "") {
                $error = "Mot de passe manquant.";
            }
    
            // Insertion si aucune erreur
            if ($error == "") {
                $user = $userModel->createUser($username, $email, $hashed_password);
                
                if ($user) {
                    $_SESSION['user_id'] = $user['User_ID'];
                    unset($_SESSION['error']);
                    unset($_SESSION['modal']);
                    header("Location: /DungeonXplorer");
                    exit();
                } else {
                    $error = "Echec de l'insertion.";
                }
            } 
                
            $_SESSION['error'] = $error;
            $_SESSION['modal'] = "signin";
            header("Location: /DungeonXplorer");
            exit();
        }
    }
    
    public function connexion() {
        session_start();
        $error = "";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
                
                $username = strip_tags($_POST["username"]);
                $password = strip_tags($_POST["password"]);
    
                require_once __DIR__ . '/../models/user.php';
                require_once __DIR__ . '/../../config/con_db.php';

                $userModel = new User($db);
                $user = $userModel->authenticate($username, $password);
    
                if ($user) {
                    unset($_SESSION['modal']);
                    $_SESSION['user_id'] = $user['User_ID'];
                    header("Location: /DungeonXplorer");
                    exit();
                } else {
                    $error = "Identifiants incorrects.";
                }
            } else {
                $error = "Tous les champs doivent être remplis.";
            }
        }
    
        $_SESSION['error'] = $error;
        $_SESSION['modal'] = "login";
        header("Location: /DungeonXplorer");
        exit();
    }

    public function deconnexion(){
        session_start();
        $_SESSION = array();
        session_destroy();
        header('Location: /DungeonXplorer');
        exit();
    }
    
}
?>