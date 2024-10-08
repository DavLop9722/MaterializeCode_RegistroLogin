<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error-message {
        color: red;
        background-color: #f8d7da;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        }
        </style>
        </div>"
    <title>Inicio de Sesión</title>
</head>
<body>
    
</body>
</html><?php 


require_once __DIR__.'/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new Usuario($dni, $username, $email, $password, $role);  // Clase abstracta, así que asegúrate de crear el objeto según el tipo de usuario
    if ($usuario->login($email, $password)) {
        // Redirigir al dashboard según el rol
        if ($_SESSION['role'] == 'alumno') {
            header("Location: alumno_dashboard.php");
        } elseif ($_SESSION['role'] == 'profesor') {
            header("Location: profesor_dashboard.php");
        } elseif ($_SESSION['role'] == 'coordinador') {
            header("Location: coordinador_dashboard.php");
        }
    } else {
        echo "Error en el login. Verifica tus credenciales.";
    
        // if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
        // echo "<div class='error-message'>Credenciales inválidas. Por favor, inténtelo de nuevo."
        // ;

        
        // }
        
    }
    
}

?>