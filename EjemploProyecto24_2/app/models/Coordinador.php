<?php

require_once 'Usuario.php';

class Coordinador extends Usuario {
    private $idCoordinador;
    private $carrera;

    public function __construct($dni, $username, $email, $password, $idCoordinador, $carrera) {
        parent::__construct($dni, $username, $email, $password, 'coordinador');
        $this->idCoordinador = $idCoordinador;
        $this->carrera = $carrera;
    }

    public function gestionarCarrera() {
        // Lógica para gestionar la carrera
    }

    public function asignarProfesor($profesor) {
        // Lógica para asignar un profesor a una materia
    }
}
?>
