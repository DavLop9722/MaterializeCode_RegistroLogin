<?php

require_once 'Usuario.php';

class Profesor extends Usuario {
    private $idProfesor;
    private $especialidad;

    public function __construct($dni, $username, $email, $password, $idProfesor, $especialidad) {
        parent::__construct($dni, $username, $email, $password, 'profesor');
        $this->idProfesor = $idProfesor;
        $this->especialidad = $especialidad;
    }
// Getters y setters
    public function getIdProfesor() {
        return $this->idProfesor;
    }
    public function setIdProfesor($idProfesor){
        $this->idProfesor = $idProfesor;
     }
     
    public function getEspecialidad() {
        return $this->especialidad;
    }
    public function setEspecialidad($especialidad){
        $this->especialidad = $especialidad;
     }
    public function subirArchivo($archivo) {
        // Lógica para subir un archivo
    }

    public function descargarArchivo($idArchivo) {
        // Lógica para descargar un archivo
    }

    public function verAlumnos() {
        // Lógica para ver alumnos en sus materias
    }
    public function verAlumnosPorMateria(){
        
    }


    

}

    


?>
