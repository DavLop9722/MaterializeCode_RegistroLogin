<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Ruta a tu archivo CSS -->
</head>
<body>

    <h1>Dashboard del Alumno</h1>

    <section>
        <h2>Materias Inscritas</h2>
        <ul>
            <?php if (!empty($materias)): ?>
                <?php foreach ($materias as $materia): ?>
                    <li><?php echo htmlspecialchars($materia['nombreMateria']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No estás inscrito en ninguna materia.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section>
        <h2>Archivos Subidos/Descargados Recientemente</h2>
        <ul>
            <?php if (!empty($archivosRecientes)): ?>
                <?php foreach ($archivosRecientes as $archivo): ?>
                    <li><?php echo htmlspecialchars($archivo['nombreArchivo']); ?> (Subido el: <?php echo htmlspecialchars($archivo['fechaSubida']); ?>)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No has subido o descargado archivos recientemente.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section>
        <h2>Notificaciones Importantes</h2>
        <ul>
            <?php if (!empty($notificaciones)): ?>
                <?php foreach ($notificaciones as $notificacion): ?>
                    <li><?php echo htmlspecialchars($notificacion['titulo']); ?> - <?php echo htmlspecialchars($notificacion['fecha']); ?></li>
                    <p><?php echo htmlspecialchars($notificacion['descripcion']); ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No tienes notificaciones importantes.</li>
            <?php endif; ?>
        </ul>
    </section>

</body>
</html>
