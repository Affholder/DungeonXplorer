<?php
require_once __DIR__ . '/../../config/con_db.php';

class User {
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    /**
     * Vérifier si un email existe déjà
     */
    public function emailExists($email) {
        $req = $this->db->prepare("SELECT COUNT(*) as total FROM Game_User WHERE email = ?");
        $req->execute([$email]);
        $res = $req->fetch();
        return $res['total'] > 0;
    }
    
    /**
     * Vérifier si un nom d'utilisateur existe déjà
     */
    public function usernameExists($username) {
        $req = $this->db->prepare("SELECT COUNT(*) as total FROM Game_User WHERE username = ?");
        $req->execute([$username]);
        $res = $req->fetch();
        return $res['total'] > 0;
    }
    
    /**
     * Créer un nouvel utilisateur
     */
    public function createUser($username, $email, $hashedPassword) {
        try {
            $insert_user = "INSERT INTO Game_User(username, email, password) VALUES(:username, :email, :password)";
            $req = $this->db->prepare($insert_user);
            $req->bindParam(':username', $username);
            $req->bindParam(':email', $email);
            $req->bindParam(':password', $hashedPassword);
            
            if ($req->execute()) {
                // Récupérer l'ID du nouvel utilisateur
                return $this->getUserByUsername($username);
            }
            return false;
        } catch (Exception $e) {
            error_log("Erreur création utilisateur: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Récupérer un utilisateur par son nom d'utilisateur
     */
    public function getUserByUsername($username) {
        $req = $this->db->prepare("SELECT * FROM Game_User WHERE username = ?");
        $req->execute([$username]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Récupérer un utilisateur par son ID
     */
    public function getUserById($userId) {
        $req = $this->db->prepare("SELECT * FROM Game_User WHERE User_ID = ?");
        $req->execute([$userId]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Vérifier les identifiants de connexion
     */
    public function authenticate($username, $password) {
        $user = $this->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    /**
     * Mettre à jour les informations d'un utilisateur
     */
    public function updateUser($userId, $data) {
        try {
            $fields = [];
            $params = [];
            
            if (isset($data['username'])) {
                $fields[] = "username = :username";
                $params[':username'] = $data['username'];
            }
            if (isset($data['email'])) {
                $fields[] = "email = :email";
                $params[':email'] = $data['email'];
            }
            if (isset($data['password'])) {
                $fields[] = "password = :password";
                $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            
            if (empty($fields)) {
                return false;
            }
            
            $params[':user_id'] = $userId;
            $sql = "UPDATE Game_User SET " . implode(', ', $fields) . " WHERE User_ID = :user_id";
            
            $req = $this->db->prepare($sql);
            return $req->execute($params);
            
        } catch (Exception $e) {
            error_log("Erreur mise à jour utilisateur: " . $e->getMessage());
            return false;
        }
    }
    
/**
 * Supprimer un utilisateur et toutes ses données associées
 */
public function deleteUser($userId) {
    try {
        // Commencer une transaction
        $this->db->beginTransaction();
        
        // 1. Supprimer les inventaires des héros
        $req = $this->db->prepare("
            DELETE i FROM Inventory i
            INNER JOIN Hero h ON i.hero_id = h.id
            WHERE h.user_id = :user_id
        ");
        $req->bindParam(':user_id', $userId);
        $req->execute();
        
        // 2. Supprimer les progrès liés aux héros de l'utilisateur
        $req = $this->db->prepare("
            DELETE p FROM Hero_Progress p
            INNER JOIN Hero h ON p.hero_id = h.id
            WHERE h.user_id = :user_id
        ");
        $req->bindParam(':user_id', $userId);
        $req->execute();

        // 3. Supprimer les spells de l'utilisateur
        $req = $this->db->prepare("
            DELETE s FROM hero_spell s
            INNER JOIN Hero h ON s.hero_id = h.id
            WHERE h.user_id = :user_id
        ");
        $req->bindParam(':user_id', $userId);
        $req->execute();
        
        // 4. Supprimer les héros
        $req = $this->db->prepare("DELETE FROM Hero WHERE user_id = :user_id");
        $req->bindParam(':user_id', $userId);
        $req->execute();
        
        // 5. Supprimer l'utilisateur
        $req = $this->db->prepare("DELETE FROM Game_User WHERE User_ID = :user_id");
        $req->bindParam(':user_id', $userId);
        $req->execute();
        
        // Valider la transaction
        $this->db->commit();
        return true;
        
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $this->db->rollBack();
        error_log("Erreur suppression utilisateur: " . $e->getMessage());
        return false;
    }
}
    
    /**
     * Valider le format d'un email
     */
    public function validateEmail($email) {
        return preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
    }
    
    /**
     * Valider le format d'un mot de passe
     * Au moins 8 caractères, avec minuscule, majuscule, chiffre et caractère spécial
     */
    public function validatePassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#^()_+\-=\[\]{};:,.<>])[A-Za-z\d@$!%*?&#^()_+\-=\[\]{};:,.<>]{8,}$/', $password);
    }
    
    /**
     * Obtenir le nombre total d'utilisateurs
     */
    public function getTotalUsers() {
        $req = $this->db->query("SELECT COUNT(*) as total FROM Game_User");
        $res = $req->fetch();
        return $res['total'];
    }
    
}
?>