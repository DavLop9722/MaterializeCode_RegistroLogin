<?php
require_once __DIR__.'/../models/Usuario.php';
 //manejar el registro de usuarios a través de una llamada POST, recoger los datos enviados por el formulario y
 // luego registrar un usuario mediante el método estático registrar() de la clase Usuario.
 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (Usuario::registrar($dni, $username, $email, $password, $role)) {
        echo "Usuario registrado correctamente. Inicie sesión.";
    } else {
        echo "Error al registrar el usuario. Puede que ya exista.";
    }
}
?>
