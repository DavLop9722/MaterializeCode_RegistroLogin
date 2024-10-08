<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="../Asset//css/registro.css">
</head>
<body>
    
    <form action="../Controller/RegisterController.php" method="POST">
        <h1>MaterializeCode</h1>
        <h2>Registro de usuario</h2><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <br>

        <label for="username">Nombre y Apellido:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="cemail">Correo:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <select name="role" required>
            <option value="Alumno">Alumno</option>
            <option value="Profesor">Profesor</option>
            <option value="Coordinador">Coordinador</option>
        </select>
        <br><br>

        <button type="submit">Regístrame</button>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
    </form>

    <div class="message">
            <?php
              // Manejar el request
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $controller = new RegisterController();
                $dni = $_POST['dni'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $role = $_POST['role'];
            
                $result = $controller->register($dni, $username, $email, $password, $role);
                echo htmlspecialchars($result);
            }
            ?>
        </div>

</body>
</html>