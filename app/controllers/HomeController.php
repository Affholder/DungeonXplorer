<?php
class HomeController {
    public function index() {
        require_once 'app/views/home.php';
    }

    public function inscription(){
        session_start();
        $error="";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset( $_POST["email"])){
                $email = strip_tags($_POST["email"]);
            }
            else{
                $error="email manquant";
            }
            if(isset( $_POST["username"])){
                $username = strip_tags($_POST["username"]);
                require_once __DIR__ . '/../../config/con_db.php';
                $req = $db->prepare("select count(*) as total from Game_User where username = ?");
                $req->execute([$username]);
                $res = $req->fetch();
                if($res['total'] > 0){
                    $error="ce nom d'utilisateur est déjà pris";
                }
                
            }
            else{
                $error="nom d'utilisateur manquant";
            }
            if(isset( $_POST["password"]) && isset( $_POST["password-confirm"])){
                if($_POST["password"] != $_POST["password-confirm"]){
                    $error = "Les mots de passe ne corresspondent pas.";
                }
                else{
                    $password = strip_tags($_POST["password"]);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                }
            }

            require_once __DIR__ . '/../../config/con_db.php';
            if($error == ""){
                $insert_user = "insert into Game_User(username, email, password) values( :username, :email, :password)";
                $req = $db->prepare($insert_user);
                $req->bindParam(':username', $username);
                $req->bindParam(':email', $email);
                $req->bindParam(':password', $hashed_password);

                if ($req->execute()) {

                    $req = $db->prepare("select User_ID from Game_User where username = ?");
                    $req->execute([$username]);
                    $res = $req->fetch();
                    $_SESSION['user_id'] = $res['User_ID'];
                    header("Location: /DungeonXplorer");
                    exit();
                } 
                else {
                    echo 'Echec de l\'insertion.';
                }
            }

            else echo $error;
            header("Location: /DungeonXplorer");
            exit();       
            

        }    
    }

    public function connexion(){
        session_start();
        $error="";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if(isset( $_POST["username"])){
                $username = strip_tags($_POST["username"]);
            }
            if(isset( $_POST["password"])){
                $password = strip_tags($_POST["password"]);
            }

            require_once __DIR__ . '/../../config/con_db.php';
            $req = $db->prepare("select * from Game_User where username = ?");
            $req->execute([$username]);
            $res = $req->fetch();
            
            if(password_verify($password,$res['password'])){
                //echo 'connexion réussie';
                $_SESSION['user_id'] = $res['User_ID'];
                //var_dump($_SESSION);
                header("Location: /DungeonXplorer");
                exit();
            }
            else{
                echo 'pas bon :[';
            }

            
        }

            require_once __DIR__ . '/../../config/con_db.php';

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