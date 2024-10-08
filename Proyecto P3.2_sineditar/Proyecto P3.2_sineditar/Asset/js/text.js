// const buttonP = document.getElementById('buttonP');
// const buttonN = document.getElementById('buttonN');

//         // Solicitar permisos para notificaciones
//         buttonP.addEventListener('click', async () => {
//             try {
//                 await Notification.requestPermission();
//                 console.log('Permisos concedidos para notificaciones.');
//             } catch (error) {
//                 console.error('Error al solicitar permisos:', error);
//             }
//         });

//         // Lanzar una notificación
//         buttonN.addEventListener('click', () => {
//             if (Notification.permission === 'granted') {
//                 new Notification('¡Hola!', {
//                     body: 'Esta es una notificación de ejemplo.',
//                     icon: 'icono.png' // Ruta a un icono opcional
//                 });
//             } else {
//                 console.warn('No se han concedido permisos para notificaciones.');
//             }
            
//         });

const noti1 = document.getElementById('notificacion1');

noti1.onclick = function() {
    alert('Mañana no hay clases') };


const noti2 = document.getElementById('notificacion2');

noti2.onclick = function(){
    alert('TODOS DESAPROBARON')
};

//boton para buscar un estudiante.

let editarIndicado = () => {
    let idEstud = document.getElementById('id_estudiante').value;
    if (idEstud) {
        return window.location.href = "?controller=Estudiante&action=Estudiante_Controlador::mostrarUnEstudiante&id_estudiante="+idEstud;
    } else {
        return window.location.href = "?controller=Estudiante&action=Estudiante_Controlador::mostrarEstudiantes";      
    }
}