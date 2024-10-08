<?php

require_once __DIR__. '/../../app/controllers/Conexion.php'; 

abstract class Usuario {
    protected $dni;
    protected $username;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($dni, $username, $email, $password, $role) {
        $this->dni = $dni;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
    }

    
    public function getDni() {
        return $this->dni;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
     }
     // Getters para email y role
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
     }

    public function getRole() {
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
     }
     public function getPassword() {
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
     }
     

    // Método para login
    public function login($email, $password) {
        $conn = Conexion::getInstance();
        $sql = "SELECT * FROM Usuario WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Usuario autenticado correctamente
            session_start();
            $_SESSION['dni'] = $user['dni'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            // Error de autenticación
            return false;
        }
    }

    // Método para logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    // Método para registrar usuario
    public function registrar($dni, $username, $email, $password, $role) {
        $conn = Conexion::getInstance();
        // Verificar si el usuario ya existe
        $sql = "SELECT * FROM Usuario WHERE dni = :dni OR email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            // El usuario ya está registrado
            return false;
        }

        // Insertar nuevo usuario
        $sql = "INSERT INTO Usuario (dni, username, email, password, role) VALUES (:dni, :username, :email, :password, :role)";
        $stmt = $conn->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
  

    // Método para borrar usuario
    public static function borrar($dni) {
        $conn = Conexion::getInstance();
        $sql = "DELETE FROM Usuario WHERE dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        
        return $stmt->execute();
    }

    // Método para editar usuario
    public static function editar($dni, $username, $email, $password = null, $role) {
        $conn = Conexion::getInstance();
        $sql = "UPDATE Usuario SET username = :username, email = :email, role = :role";

        // Si se pasa una nueva contraseña, también actualizarla
        if ($password !== null) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql .= ", password = :password";
        }
        
        $sql .= " WHERE dni = :dni";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':dni', $dni);

        // Si hay una nueva contraseña, bindParam también para la contraseña
        if ($password !== null) {
            $stmt->bindParam(':password', $hashed_password);
        }

        return $stmt->execute();
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

