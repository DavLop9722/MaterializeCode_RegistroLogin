<?php

require_once __DIR__."/../../app/controllers/AuthController.php";

class Alumno extends Usuario {
    private $matricula;
    private $carrera;

    public function __construct($dni, $username, $email, $password, $matricula, $carrera) {
        parent::__construct($dni, $username, $email, $password, 'alumno');
        $this->matricula = $matricula;
        $this->carrera = $carrera;
    }

    // Getter para la matrícula
public function getMatricula() {
    return $this->matricula;
}

// Setter para la matrícula
public function setMatricula($matricula) {
    $this->matricula = $matricula;
}

// Getter para la idCarrera
public function getCarrera() {
    return $this->carrera;
}

// Setter para la idCarrera
public function setCarrera($carrera) {
    $this->carrera = $carrera;
}


public static function register($dni, $username, $email, $password, $matricula, $carrera) {
    // Lógica específica de alumnos (validaciones, generación de matrícula, etc.)
    
    // Hasheado de la contraseña antes de pasarla al método padre
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Registrar al alumno llamando al método registrar() del padre
    $result = parent::registrar($dni, $username, $email, $hashedPassword, 'alumno');

    if ($result) {
        // Inserción en tabla específica de alumnos con la matrícula y carrera
        $db = Conexion::getInstance();
        $query = "INSERT INTO alumno (dni, matricula, idCarrera) VALUES (:dni, :matricula, :carrera)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':carrera', $carrera);
        
        return $stmt->execute();
    }

    return false; // Si falla el registro
}


    public function subirArchivo($archivo) {
        // Lógica para subir un archivo
    }

    public function descargarArchivo($idArchivo) {
        // Lógica para descargar un archivo
    }

    public function verMateriasInscritas() {
        // Lógica para ver materias inscritas
    }

    public static function obtenerAlumnoPorDNI($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT u.*, a.matricula, c.nombreCarrera 
                FROM Usuario u 
                JOIN Alumno a ON u.dni = a.dni 
                JOIN Carrera c ON a.idCarrera_id = c.idCarrera 
                WHERE u.dni = :dni AND u.role = 'alumno'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Alumno($data['dni'], $data['username'], $data['email'], $data['password'], $data['matricula'], $data['nombreCarrera']);
    }

    public static function obtenerNotificacionesImportantes($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Notificaciones WHERE dni_alumno = :dni ORDER BY fecha_limite ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
