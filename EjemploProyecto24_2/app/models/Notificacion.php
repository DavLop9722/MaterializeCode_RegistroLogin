<?php

class Notificacion {

    public static function obtenerNotificacionesPorAlumno($dni) {
        $conn = Conexion::getInstance();
        $sql = "SELECT n.titulo, n.descripcion, n.fecha 
                FROM Notificacion n
                WHERE n.dni_alumno = :dni
                ORDER BY n.fecha ASC
                LIMIT 5"; // Mostrar las próximas 5 notificaciones
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':dni', $dni);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
