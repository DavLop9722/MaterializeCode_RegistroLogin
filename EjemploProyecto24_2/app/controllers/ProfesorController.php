<?php

require_once '../models/Profesor.php';
require_once '../models/Archivo.php';

class ProfesorController {

    public function verAlumnos($idMateria) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $profesor = $this->obtenerProfesorPorDNI($_SESSION['dni']);
        $alumnos = $profesor->verAlumnosPorMateria($idMateria);

        require_once '../views/profesor_alumnos.php'; // Mostrar vista de alumnos
    }

    public function subirArchivo($nombreArchivo, $tipoArchivo, $url, $idMateria) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $profesor = $this->obtenerProfesorPorDNI($_SESSION['dni']);
        $profesor->subirArchivo($nombreArchivo, $tipoArchivo, $url, $idMateria);
        header("Location: /profesor_dashboard.php");
    }

    public function descargarArchivo($idArchivo) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $archivo = Archivo::obtenerArchivoPorId($idArchivo);
        if (!$archivo) {
            // El archivo no existe o no se encontró
            echo "Archivo no encontrado.";
            exit();
        }
    }

    private function obtenerProfesorPorDNI($dni) {
        // Lógica para obtener los datos del profesor desde la base de datos
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Usuario WHERE dni = :dni AND role = 'profesor'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Profesor(
            $userData['dni'],
            $userData['username'],
            $userData['email'],
            $userData['password'],
            $userData['idProfesor'],
            $userData['especialidad']
        );
    }
}
?>
