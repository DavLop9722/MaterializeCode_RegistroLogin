// // Obtener el campo de selección de rol
// const roleSelect = document.getElementById('role');

// // Obtener los campos que queremos mostrar/ocultar
// const carreraField = document.getElementById('carreraField');
// const especialidadField = document.getElementById('especialidadField');

// // Función para mostrar/ocultar campos según el rol seleccionado
// roleSelect.addEventListener('change', function() {
//     const selectedRole = this.value;

//     // Ocultar todos los campos al inicio
//     carreraField.style.display = 'none';
//     especialidadField.style.display = 'none';

//     // Mostrar el campo correspondiente según el rol seleccionado
//     if (selectedRole === 'alumno') {
//         carreraField.style.display = 'block';   // Mostrar campo de carrera para alumnos
//     } else if (selectedRole === 'profesor') {
//         especialidadField.style.display = 'block';  // Mostrar campo de especialidad para profesores
//     } else if (selectedRole === 'coordinador') {
//         carreraField.style.display = 'block';  // Mostrar campo de carrera para coordinadores
//     }
// });

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