<?php
session_start();
require_once '../config/database.php';
require_once '../app/models/UserModel.php';

class LoginController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function login($username, $password) {
        $stmt = $this->userModel->findByUsername($username);
        if($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['failed_attempts'] >= 3 && time() - strtotime($row['last_attempt']) < 300) {
                return "Cuenta bloqueada temporalmente. Intenta de nuevo en 5 minutos.";
            }

            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Restablecer intentos fallidos
                $this->userModel->id = $row['id'];
                $this->userModel->failed_attempts = 0;
                $this->userModel->updateFailedAttempts();

                return "success";
            } else {
                // Incrementar intentos fallidos
                $this->userModel->id = $row['id'];
                $this->userModel->failed_attempts = $row['failed_attempts'] + 1;
                $this->userModel->last_attempt = date('Y-m-d H:i:s');
                $this->userModel->updateFailedAttempts();

                return "Credenciales incorrectas.";
            }
        } else {
            return "Usuario no encontrado.";
        }
    }
}

// Manejar el request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new LoginController();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $controller->login($username, $password);
    if ($result === "success") {
        header("Location: ../public/dashboard.php");
    } else {
        echo $result;
    }
}
?>
