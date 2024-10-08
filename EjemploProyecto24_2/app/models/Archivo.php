<?php

class Archivo {
    private $idArchivo;
    private $nombreArchivo;
    private $tipoArchivo;
    private $url;
    private $subidoPor;
    private $fechaSubida;

    public function __construct($idArchivo, $nombreArchivo, $tipoArchivo, $url, $subidoPor, $fechaSubida) {
        $this->idArchivo = $idArchivo;
        $this->nombreArchivo = $nombreArchivo;
        $this->tipoArchivo = $tipoArchivo;
        $this->url = $url;
        $this->subidoPor = $subidoPor;
        $this->fechaSubida = $fechaSubida;
    }

    public function descargar() {
        // Lógica para descargar el archivo
    }

    public static function obtenerArchivoPorId(){

    }

    public static function obtenerArchivosRecientesPorAlumno($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT a.idArchivo, a.nombreArchivo, a.fechaSubida
                FROM Archivo a
                WHERE a.subidoPor = :dni
                ORDER BY a.fechaSubida DESC
                LIMIT 5"; // Mostrar los últimos 5 archivos
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // public static function obtenerArchivosRecientesPorAlumno($dni) {
    //     $conn = Conexion::getInstance();
    //     $sql = "SELECT * FROM Archivo 
    //             WHERE subidoPor_dni = :dni 
    //             ORDER BY fechaSubida DESC LIMIT 5";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':dni', $dni);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}
?>
