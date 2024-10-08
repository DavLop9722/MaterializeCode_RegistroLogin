<?php

class Carrera {
    private $idCarrera;
    private $nombreCarrera;
    private $duracion;

    public function __construct($idCarrera, $nombreCarrera, $duracion) {
        $this->idCarrera = $idCarrera;
        $this->nombreCarrera = $nombreCarrera;
        $this->duracion = $duracion;
    }

    public function añadirMateria($materia) {
        // Lógica para añadir materia
    }

    public function verMaterias() {
        // Lógica para ver materias
    }

    public static function obtenerCarreraPorId(){

    }
}

//getters y setters



?>
