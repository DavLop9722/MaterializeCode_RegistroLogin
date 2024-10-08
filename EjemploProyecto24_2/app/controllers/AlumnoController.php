<?php

require_once '../models/Alumno.php';
require_once '../models/Archivo.php';

class AlumnoController {

   

    public function verMateriasInscritas() {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $alumno = $this->obtenerAlumnoPorDNI($_SESSION['dni']);
        $materias = $alumno->verMateriasInscritas();

        require_once '../views/alumno_materias.php'; // Mostrar vista de materias inscritas
    }

    public function subirArchivo($nombreArchivo, $tipoArchivo, $url, $idMateria) {
        session_start();
        if (!isset($_SESSION['dni'])) {
            header("Location: /login.php");
            exit();
        }

        $alumno = $this->obtenerAlumnoPorDNI($_SESSION['dni']);
        $alumno->subirArchivo($nombreArchivo, $tipoArchivo, $url, $idMateria);
        header("Location: ../../app/views/alumno_dashboard.php");
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

    private function obtenerAlumnoPorDNI($dni) {
        // Lógica para obtener los datos del alumno desde la base de datos
        $conn = Conexion::getInstance();
        $sql = "SELECT u.*, a.matricula, a.carrera_id, c.nombreCarrera, c.duracion 
                FROM Usuario u 
                JOIN Alumno a ON u.dni = a.dni 
                JOIN Carrera c ON a.carrera_id = c.idCarrera 
                WHERE u.dni = :dni AND u.role = 'alumno'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($userData) {
            // Crear el objeto Carrera con la información obtenida
            $carrera = new Carrera(
                $userData['carrera_id'],
                $userData['nombreCarrera'],
                $userData['duracion']
            );
    
            // Retornar el objeto Alumno con todos sus datos
            return new Alumno(
                $userData['dni'],
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['matricula'],
                $carrera
            );
        } else {
            return null; // En caso de que no se encuentre un alumno con ese DNI
        }
    }


    
}
?>
