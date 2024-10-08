<?php

require_once __DIR__.'/../models/Usuario.php';
require_once __DIR__.'/../models/Alumno.php';
require_once __DIR__.'/../models/Profesor.php';
require_once __DIR__.'/../models/Coordinador.php';

class AuthController {

    public function showLogin() {
        require_once __DIR__.'/../../public/login.php';
    }
    
    // Método para manejar el login
    public function login() {
        // Lógica para verificar credenciales
        // Buscar el usuario por email
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $usuario = $this->buscarUsuarioPorEmail($email);
        
        if ($usuario && $usuario->login($email, $password)) {
            // Autenticación exitosa, redirigir al dashboard según el rol
            session_start();
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['role'] = $usuario->getRole();

            switch ($usuario->getRole()) {
                case 'alumno':
                    header("Location: ../../app/views/alumno_dashboard.php");
                    break;
                case 'profesor':
                    header("Location: ../../app/views/profesor_dashboard.php");
                    break;
                case 'coordinador':
                    header("Location: ../../app/views/coordinador_dashboard.php");
                    break;
                default:
                    echo "Rol de usuario no reconocido.";
                    break;
            }
        } else {
            // Error en las credenciales
            echo "Error: Credenciales incorrectas.";
        }
    }

    // Método para manejar el registro    
    public function register() {
    // Recoger los datos del formulario
    $dni = $_POST['dni'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Se asume que 'role' también viene del formulario

    // Intentar registrar el usuario en la tabla general
    $usuario = new Usuario($dni, $username, $email, $password, $role);
    
    if ($usuario->registrar($dni, $username, $email, $password, $role)) {
        switch ($role) {
            case 'alumno':
                // Asignar carrera y generar matrícula para el alumno
                $carrera = $_POST['carrera_id']; // Recogida desde el formulario
                $matricula = $this->generarMatricula(); // Generar matrícula única

                $alumno = new Alumno($dni, $username, $email, $password, $matricula, $carrera);
                $alumno->registrar($dni, $username, $email, $password, $role, $matricula, $carrera);
                break;

            case 'profesor':
                // Generar ID de profesor y asignar especialidad
                $idProfesor = $this->generarIdProfesor();
                $especialidad = $_POST['especialidad']; // Recibida desde el formulario

                $profesor = new Profesor($dni, $username, $email, $password, $idProfesor, $especialidad);
                $profesor->registrar($dni, $username, $email, $password, $role, $idProfesor, $especialidad);
                break;

            case 'coordinador':
                // Generar ID de coordinador y asignar carrera
                $idCoordinador = $this->generarIdCoordinador();
                $carreraId = $_POST['carrera_id']; // Carrera gestionada por el coordinador

                $coordinador = new Coordinador($dni, $username, $email, $password, $idCoordinador, $carreraId);
                $coordinador->registrar($dni, $username, $email, $password, $role, $idCoordinador, $carreraId);
                break;

            default:
                echo "Rol no reconocido.";
                return;
        }
    } else {
        echo "El usuario ya existe.";
        return;
    }

    // Redirigir al login o algún otro destino después del registro
    header("Location: ../../app/views/login.php");
    exit();
}
   
    
        // Método para generar matrícula única de alumno
        private function generarMatricula() {
            return "MAT-" . uniqid(); // Generar matrícula única
        }
    
        // Método para generar ID único de profesor
        private function generarIdProfesor() {
            return "PROF-" . uniqid();
        }
    
        // Método para generar ID único de coordinador
        private function generarIdCoordinador() {
            return "COORD-" . uniqid();
        }
    

     // Método privado para buscar un usuario por su email
     private function buscarUsuarioPorEmail($email) {
        // Conexión a la base de datos
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Usuario WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Obtener el usuario
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$userData) {
            return null;
        }

        // Crear la instancia de la clase correspondiente dependiendo del rol
        switch ($userData['role']) {
            case 'alumno':
                
                    // Obtener la carrera asociada al alumno
                    $sqlCarrera = "SELECT c.idCarrera, c.nombreCarrera, c.duracion 
                    FROM Carrera c
                    JOIN Alumno a ON a.idCarrera = c.idCarrera
                    WHERE a.dni = :dni";
                    $stmtCarrera = $conn->prepare($sqlCarrera);
                    $stmtCarrera->bindParam(':dni', $userData['dni']);
                    $stmtCarrera->execute();
                    $carreraData = $stmtCarrera->fetch(PDO::FETCH_ASSOC);

                    // Si se encontró la carrera, crear una instancia de Carrera
                    if ($carreraData) {
                    $carrera = new Carrera(
                    $carreraData['idCarrera'],
                    $carreraData['nombreCarrera'],
                    $carreraData['duracion']
                    );
                    } else {
                    $carrera = null;  // Si no se encuentra una carrera asociada, puede ser nulo
                    }

                    // Crear la instancia de Alumno
                    return new Alumno(
                    $userData['dni'],
                    $userData['username'],
                    $userData['email'],
                    $userData['password'], // El hash de la contraseña ya está almacenado
                    $userData['matricula'],
                    $carrera // Se pasa el objeto Carrera al constructor de Alumno
                    );
                    
                    
            case 'profesor':
                return new Profesor(
                    $userData['dni'],
                    $userData['username'],
                    $userData['email'],
                    $userData['password'],
                    $userData['idProfesor'],
                    $userData['especialidad']
                );
            case 'coordinador':

                // Obtener la carrera asociada al coordinador
                $sqlCarrera = "SELECT c.idCarrera, c.nombreCarrera, c.duracion 
                FROM Carrera c
                JOIN Coordinador a ON a.idCarrera = c.idCarrera
                WHERE a.dni = :dni";
                $stmtCarrera = $conn->prepare($sqlCarrera);
                $stmtCarrera->bindParam(':dni', $userData['dni']);
                $stmtCarrera->execute();
                $carreraData = $stmtCarrera->fetch(PDO::FETCH_ASSOC);

                // Si se encontró la carrera, crear una instancia de Carrera
                if ($carreraData) {
                $carrera = new Carrera(
                $carreraData['idCarrera'],
                $carreraData['nombreCarrera'],
                $carreraData['duracion']
                );
                } else {
                $carrera = null;  // Si no se encuentra una carrera asociada, puede ser nulo
                }


                return new Coordinador(
                    $userData['dni'],
                    $userData['username'],
                    $userData['email'],
                    $userData['password'],
                    $userData['idCoordinador'],
                    $carrera,
                );
            default:
                return null;
        }

        
    }

 
    
}
?>

