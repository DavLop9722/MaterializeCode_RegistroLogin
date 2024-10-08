<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
</head>
<body>
    <form action="../controllers/RegisterController.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="role" required>
            <option value="Alumno">Alumno</option>
            <option value="Profesor">Profesor</option>
            <option value="Coordinador">Coordinador</option>
        </select>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
