<?php

require_once '../models/Alumno.php';
require_once '../models/Archivo.php';
require_once '../models/Materia.php';
require_once '../models/Notificacion.php';

class AlumnoDashboardController {

    public function index() {
        session_start();
        $dni = $_SESSION['dni']; // Se asume que el alumno está logueado y su DNI está almacenado en la sesión

        // Obtener las materias inscritas
        $materias = Materia::obtenerMateriasPorAlumno($dni);

        // Obtener los archivos subidos o descargados recientemente
        $archivosRecientes = Archivo::obtenerArchivosRecientesPorAlumno($dni);

        // Obtener las notificaciones importantes (exámenes, fechas de entrega)
        $notificaciones = Notificacion::obtenerNotificacionesPorAlumno($dni);

        // Cargar la vista con los datos
        include '../../app/views/alumno_dashboard.php';
    }
}
