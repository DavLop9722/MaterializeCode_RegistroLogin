<?php

require_once '../models/Usuario.php';

class UsuarioController {

    // Método para mostrar la información del perfil del usuario
    public function mostrarPerfil($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Usuario WHERE dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            // Renderizar vista con información del usuario
            require_once '../views/perfil.php'; // Mostrar vista del perfil
        } else {
            echo "Usuario no encontrado.";
        }
    }

    // Método para actualizar información del perfil
    public function actualizarPerfil($dni, $data) {
        $conn = Conexion::getInstance();
        $sql = "UPDATE Usuario SET username = :username, email = :email WHERE dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        if ($stmt->execute()) {
            echo "Perfil actualizado.";
        } else {
            echo "Error al actualizar el perfil.";
        }
    }

    // Método para cerrar sesión
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login.php");
    }
}
?>
