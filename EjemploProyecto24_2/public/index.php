<?php
// Enrutamiento básico
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Control de acceso para login y registro
//     require_once 'app/controllers/AuthController.php';
//     $authController = new AuthController();
    
//     if (isset($_POST['email']) && isset($_POST['password'])) {
//         $authController->login($_POST['email'], $_POST['password']);
//     } elseif (isset($_POST['dni']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
//         $authController->register($_POST['dni'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
//     }
// } else {
//     require_once '../public/login.php'; // Redirigir a la página de login por defecto
// }


define('CONTROLLERS_FOLDER', __DIR__."/../app/controllers/");
define('DEFAULT_CONTROLLER', "Auth"); // Cambiar a "Estudiante_Controller"
define('DEFAULT_ACTION', "showLogin");


$controllerName = DEFAULT_CONTROLLER;
if (!empty($_GET['controller'])) {
    $controller = $_GET['controller']; // Asegúrate de que el controlador tiene el sufijo "_Controller"
}

$action = DEFAULT_ACTION;
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


// Construir la ruta del controlador
$controllerName = $controllerName.'Controller';
$controllerFile = CONTROLLERS_FOLDER . $controllerName . '.php';

echo "<br>";
// echo $controller;
try {
    // Verificar si el archivo del controlador existe
    if (is_file($controllerFile)) {
        require_once($controllerFile);

        // Verificar si la clase del controlador existe
        if (class_exists($controllerName)) {
            $controllerInstance = new $controllerName();

            // Verificar si la acción existe y es callable
            if (is_callable([$controllerInstance, $action])) {
                // Llamar a la acción
                $controllerInstance->$action();
            } else {
                throw new Exception('La acción no existe - 404 not found');
            }
        } else {
            throw new Exception('La clase del controlador no existe - 404 not found');
        }
    } else {
        throw new Exception('El controlador no existe - 404 not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}



?>