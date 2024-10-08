<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="../controllers/LoginController.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Login</button>
        
        <p><a href="register.php">Registrarse</a></p>

    </form>
</body>
</html>
