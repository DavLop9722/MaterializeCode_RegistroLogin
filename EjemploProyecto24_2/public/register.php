<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
   
</head>
<body>
    <h2>Registro de Usuario</h2>

    <form action="?controller=Auth&action=register" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" placeholder="DNI" required><br><br>

        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" required><br><br>

        <label for="role">Rol:</label>
        <select id="role" name="role" required>
            <option value="">Seleccione un rol</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
            <option value="coordinador">Coordinador</option>
        </select><br><br>

        <!-- Campo para carrera (solo visible para alumnos y coordinadores) -->
        <div id="carreraField" style="display: none;">
        <select name="carrera_id">
            <option value="">Seleccione una carrera</option>
            <option value="1">Software </option>
            <option value="2">Enfermeria</option>
            <option value="3">Tec.agropecuario</option>
            <option value="4">Cs.Educacion</option>
            <!-- Más opciones -->
        </select>
    </div><br>

        <!-- Campo para especialidad (solo visible para profesores) -->
        <div id="especialidadField" style="display: none;">
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" placeholder="Especialidad">
        </div><br>

        <button type="submit">Registrarse</button>
    </form>

    
    <script>
        // Obtener el campo de selección de rol
        const roleSelect = document.getElementById('role');

        // Obtener los campos que queremos mostrar/ocultar
        const carreraField = document.getElementById('carreraField');
        const especialidadField = document.getElementById('especialidadField');

        // Función para mostrar/ocultar campos según el rol seleccionado
        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;

            // Ocultar todos los campos al inicio
            carreraField.style.display = 'none';
            especialidadField.style.display = 'none';

            // Mostrar el campo correspondiente según el rol seleccionado
            if (selectedRole === 'alumno' || selectedRole === 'coordinador') {
                carreraField.style.display = 'block'; // Mostrar campo de carrera para alumnos o coordinadores
            }

            if (selectedRole === 'profesor') {
                especialidadField.style.display = 'block'; // Mostrar campo de especialidad para profesores
            }
        });
    </script>

    <!-- <script src="/public/js/script.js" type="text/JavaScript"></script> -->
</body>
</html>



