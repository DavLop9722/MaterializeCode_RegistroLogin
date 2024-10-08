<?php

class UserModel {
    private $conn;
    private $table_name = "users";

    public $id;
    public $dni;
    public $username;
    public $email;
    public $password;
    public $role;
    public $failed_attempts;
    public $last_attempt;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByUsername($dni) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE dni = :dni LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dni', $dni);
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

    // public function create() {
    //     $query = "INSERT INTO " . $this->table_name . " (dni, username, email, password, role) VALUES (:dni, :username, :email :password, :role)";
    
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':dni', $this->dni);
    //     $stmt->bindParam(':username', $this->username);
    //     $stmt->bindParam(':email', $this->email);
    //     $stmt->bindParam(':password', $this->password);
    //     $stmt->bindParam(':role', $this->role);
    
    //     if($stmt->execute()) {
    //         return true;
    //     }
    //     return false;
    // }
        // Método para crear un nuevo usuario
        public function create() {
            $query = "INSERT INTO " . $this->table_name . " 
                      SET dni=:dni, username=:username, email=:email, password=:password, role=:role";
    
            $stmt = $this->conn->prepare($query);
    
            // Limpia los datos
            $this->dni = htmlspecialchars(strip_tags($this->dni));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->role = htmlspecialchars(strip_tags($this->role));
    
            // Vincula los datos
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT)); // Encriptación de la contraseña
            $stmt->bindParam(':role', $this->role);
    
            // Ejecuta la consulta
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    
        // Método para leer los usuarios
        public function read() {
            $query = "SELECT * FROM " . $this->table_name;
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
            return $stmt;
        }
    
        // Método para leer un solo usuario por ID
        public function read_single() {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Asigna los valores a las propiedades del objeto
            $this->dni = $row['dni'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->role = $row['role'];
            $this->failed_attempts = $row['failed_attempts'];
            $this->last_attempt = $row['last_attempt'];
        }
    
        // Método para actualizar un usuario
        public function update() {
            $query = "UPDATE " . $this->table_name . "
                      SET dni = :dni, username = :username, email = :email, password = :password, role = :role, failed_attempts = :failed_attempts, last_attempt = :last_attempt
                      WHERE id = :id";
    
            $stmt = $this->conn->prepare($query);
    
            // Limpia los datos
            $this->dni = htmlspecialchars(strip_tags($this->dni));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->role = htmlspecialchars(strip_tags($this->role));
            $this->failed_attempts = htmlspecialchars(strip_tags($this->failed_attempts));
            $this->last_attempt = htmlspecialchars(strip_tags($this->last_attempt));
    
            // Vincula los datos
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':failed_attempts', $this->failed_attempts);
            $stmt->bindParam(':last_attempt', $this->last_attempt);
            $stmt->bindParam(':id', $this->id);
    
            // Ejecuta la consulta
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    
        // Método para eliminar un usuario
        public function delete() {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    
            $stmt = $this->conn->prepare($query);
    
            $this->id = htmlspecialchars(strip_tags($this->id));
    
            $stmt->bindParam(':id', $this->id);
    
            // Ejecuta la consulta
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    }
    
    

?>
