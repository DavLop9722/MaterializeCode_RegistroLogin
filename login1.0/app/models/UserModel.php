<?php

class UserModel {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $username;
    public $password;
    public $role;
    public $failed_attempts;
    public $last_attempt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt;
    }

    public function updateFailedAttempts() {
        $query = "UPDATE " . $this->table_name . " SET failed_attempts = :failed_attempts, last_attempt = :last_attempt WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':failed_attempts', $this->failed_attempts);
        $stmt->bindParam(':last_attempt', $this->last_attempt);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (:username, :password, :role)";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
    
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}
?>
