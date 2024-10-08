<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Determinar el rol del usuario
$role = $_SESSION['role'];

// Contenido específico según el rol del usuario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<?php if ($role == 'Alumno'): ?>
    <h2>Panel de Alumno</h2>
    <p>Contenido específico para alumnos...</p>
    <!-- Aquí puedes añadir enlaces o secciones específicos para los alumnos -->
<?php elseif ($role == 'Profesor'): ?>
    <h2>Panel de Profesor</h2>
    <p>Contenido específico para profesores...</p>
    <!-- Aquí puedes añadir enlaces o secciones específicos para los profesores -->
<?php elseif ($role == 'Coordinador'): ?>
    <h2>Panel de Coordinador</h2>
    <p>Contenido específico para coordinadores...</p>
    <!-- Aquí puedes añadir enlaces o secciones específicos para los coordinadores -->
<?php else: ?>
    <p>Rol desconocido.</p>
<?php endif; ?>

<a href="logout.php">Cerrar sesión</a>

</body>
</html>
