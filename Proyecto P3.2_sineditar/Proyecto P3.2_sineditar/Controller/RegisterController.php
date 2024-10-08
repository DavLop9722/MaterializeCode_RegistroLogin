<?php
require_once '../Config/Database.php';
require_once '../Model/usuarios/UserModel.php';

class RegisterController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function register($dni, $username, $email, $password, $role) {
        // Verificar si el usuario ya existe
        $stmt = $this->userModel->findByUsername($dni);
        if($stmt->rowCount() > 0) {
            return "El nombre de usuario ya está registrado.";
        }

        // Registrar nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->dni = $dni;
        $this->userModel->username = $username;
        $this->userModel->email = $email;
        $this->userModel->password = $hashed_password;
        $this->userModel->role = $role;
       
        

        if ($this->userModel->create()) {
            return "Usuario registrado con éxito.";
        } else {
            return "Error al registrar el usuario.";
        }    
    }

    
}

?>
