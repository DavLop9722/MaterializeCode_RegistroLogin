<?php
require_once '../../config/database.php';
require_once '../models/UserModel.php';

class RegisterController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function register($username, $password, $role) {
        // Verificar si el usuario ya existe
        $stmt = $this->userModel->findByUsername($username);
        if($stmt->rowCount() > 0) {
            return "El nombre de usuario ya está registrado.";
        }

        // Registrar nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->username = $username;
        $this->userModel->password = $hashed_password;
        $this->userModel->role = $role;

        if ($this->userModel->create()) {
            return "Usuario registrado con éxito.";
        } else {
            return "Error al registrar el usuario.";
        }
    }
}

// Manejar el request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new RegisterController();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $result = $controller->register($username, $password, $role);
    echo $result;
}
?>
