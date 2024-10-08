<?php

class Materia {
    private $idMateria;
    private $nombreMateria;
    private $idCarrera;

    public function __construct($idMateria, $nombreMateria, $idCarrera) {
        $this->idMateria = $idMateria;
        $this->nombreMateria = $nombreMateria;
        $this->idCarrera = $idCarrera;
    }

    public function verProfesores() {
        // Lógica para ver profesores de la materia
    }

    public function verAlumnos() {
        // Lógica para ver alumnos inscritos en la materia
    }

    public static function obtenerMateriasPorAlumno($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT m.idMateria, m.nombreMateria 
                FROM Materia m
                JOIN AlumnoMateria am ON m.idMateria = am.idMateria
                WHERE am.dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function obtenerMateriasInscritasPorAlumno($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT m.nombreMateria 
                FROM Materia m 
                JOIN Inscripciones i ON m.idMateria = i.materia_id 
                WHERE i.alumno_dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
