<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
</head>
<body>
        <form action="?controller=Auth&action=login" method="POST">
            <h2>Iniciar Sesión</h2>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            </form>
            <a href="../public/register.php">Registrarse</a>
</body>
</html>


