<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="Asset/css/inicio_sesion.css"></link>
</head>
<body>
        
        <form class="login-container" action="../Controller/LoginController.php" method="post">
            <h1>MaterializeCode</h1>

            <h2>Inicio de Sesión</h2>
            <label for="username">Numero de DNI</label>
            <input type="text" id="dni" name="dni" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <a href="recuperarpassword.html"> Olvide mi Contraseña</a>
            <br><br>

            <a href="registro.php"> Registrarse</a>
            <br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
    
</body>
</html>