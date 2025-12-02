<?php
class HomeController {

    public function index() {
        require_once 'app/views/home.php';
    }

    public function inscription() {
        session_start();
        $error = "";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["email"])) {
                $email = strip_tags($_POST["email"]);
            } else {
                $error = "Email manquant.";
            }
    
            if (isset($_POST["username"])) {
                $username = strip_tags($_POST["username"]);
                require_once __DIR__ . '/../../config/con_db.php';
                $req = $db->prepare("SELECT count(*) as total FROM Game_User WHERE username = ?");
                $req->execute([$username]);
                $res = $req->fetch();
                if ($res['total'] > 0) {
                    $error = "Ce nom d'utilisateur est déjà pris.";
                }
            } else {
                $error = "Nom d'utilisateur manquant.";
            }
    
            if (isset($_POST["password"]) && isset($_POST["password-confirm"])) {
                if ($_POST["password"] != $_POST["password-confirm"]) {
                    $error = "Les mots de passe ne correspondent pas.";
                } else {
                    $password = strip_tags($_POST["password"]);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                }
            }
    
            if ($error == "") {
                require_once __DIR__ . '/../../config/con_db.php';
                $insert_user = "INSERT INTO Game_User(username, email, password) VALUES(:username, :email, :password)";
                $req = $db->prepare($insert_user);
                $req->bindParam(':username', $username);
                $req->bindParam(':email', $email);
                $req->bindParam(':password', $hashed_password);
    
                if ($req->execute()) {
                    $req = $db->prepare("SELECT User_ID FROM Game_User WHERE username = ?");
                    $req->execute([$username]);
                    $res = $req->fetch();
                    $_SESSION['user_id'] = $res['User_ID'];
                    unset($_SESSION['error']); // Nettoyer les erreurs
                    unset($_SESSION['modal']); // Nettoyer la modale
                    header("Location: /DungeonXplorer");
                    exit();
                } else {
                   $error = "Echec de l'insertion.";
                }
            } 
                
            $_SESSION['error'] = $error; // Stocker l'erreur dans la session
            $_SESSION['modal'] = "signin"; // Garder la modale d'inscription ouverte en cas d'erreur
            header("Location: /DungeonXplorer");
            exit();
        }
    }

    public function connexion(){
        session_start();
        $error = "";
    
        // Vérification des champs non vides
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    
                $username = strip_tags($_POST["username"]);
                $password = strip_tags($_POST["password"]);
    
                // Connexion à la base de données
                require_once __DIR__ . '/../../config/con_db.php';
                $req = $db->prepare("SELECT * FROM Game_User WHERE username = ?");
                $req->execute([$username]);
                $res = $req->fetch();
    
                if ($res) {
                    // Vérification du mot de passe
                    if (password_verify($password, $res['password'])) {
                        // Connexion réussie, démarrer la session
                        unset($_SESSION['modal']);
                        $_SESSION['user_id'] = $res['User_ID'];
                        header("Location: /DungeonXplorer");
                        exit();
                    } else {
                        // Mot de passe incorrect
                        $error = "Mot de passe incorrect.";
                    }
                } else {
                    // Utilisateur inexistant
                    $error = "Utilisateur inexistant.";
                }
    
            } else {
                // Si l'un des champs est vide
                $error = "Tous les champs doivent être remplis.";
            }
        }
    
        // Si une erreur existe, stocker l'erreur en session et rediriger
        $_SESSION['error'] = $error;
        $_SESSION['modal'] = "login"; // Indique de rouvrir la modale de connexion
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