<?php

require_once '../models/Coordinador.php';
require_once '../models/Carrera.php';

class CoordinadorController {

    public function gestionarCarrera($idCarrera) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $coordinador = $this->obtenerCoordinadorPorDNI($_SESSION['dni']);
        $carrera = Carrera::obtenerCarreraPorId($idCarrera);

        require_once '../views/coordinador_carrera.php'; // Mostrar vista de carrera
    }

    public function asignarProfesor($idMateria, $idProfesor) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $coordinador = $this->obtenerCoordinadorPorDNI($_SESSION['dni']);
        $coordinador->asignarProfesor($idMateria, $idProfesor);
        header("Location: /coordinador_dashboard.php");
    }

    private function obtenerCoordinadorPorDNI($dni) {
        // Lógica para obtener los datos del coordinador desde la base de datos
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Usuario WHERE dni = :dni AND role = 'coordinador'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Coordinador(
            $userData['dni'],
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['idCoordinador'],
            null // Aquí va la lógica para cargar la carrera gestionada
        );
    }
}
?>
