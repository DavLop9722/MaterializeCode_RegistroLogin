<?php
session_start();

// Verificar si el usuario está autenticado como alumno
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'alumno') {
    header("Location: login.php");
    exit();
}

// Cargar datos necesarios (materias, archivos, notificaciones)
require_once 'app/models/Alumno.php';
require_once 'app/models/Archivo.php';
require_once 'app/models/Materia.php';

// Obtener el DNI del alumno desde la sesión
$dni = $_SESSION['dni'];

// Obtener la información del alumno
$alumno = Alumno::obtenerAlumnoPorDNI($dni);

// Obtener materias inscritas
$materias = Materia::obtenerMateriasInscritasPorAlumno($dni);

// Obtener archivos subidos/descargados recientemente
$archivosRecientes = Archivo::obtenerArchivosRecientesPorAlumno($dni);

// Obtener notificaciones importantes
$notificaciones = Alumno::obtenerNotificacionesImportantes($dni);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Alumno</title>
    <link rel="stylesheet" href="/../../public/css/style.css">
</head>
<body>
    <header>
        <h1>Bienvenido:   <?php echo $alumno->getUsername(); ?> </h1>
    </header>

    <section>
        <h2>Materias Inscritas</h2>
        <ul>
            <?php foreach ($materias as $materia): ?>
                <li><?php echo $materia['nombreMateria']; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Archivos Recientes</h2>
        <ul>
            <?php foreach ($archivosRecientes as $archivo): ?>
                <li>
                    <a href="descargar.php?id=<?php echo $archivo['idArchivo']; ?>">
                        <?php echo $archivo['nombreArchivo']; ?> (<?php echo $archivo['fechaSubida']; ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Notificaciones Importantes</h2>
        <ul>
            <?php foreach ($notificaciones as $notificacion): ?>
                <li><?php echo $notificacion['mensaje']; ?> - Fecha límite: <?php echo $notificacion['fecha_limite']; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <footer>
        <a href="logout.php">Cerrar sesión</a>
    </footer>
</body>
</html>
