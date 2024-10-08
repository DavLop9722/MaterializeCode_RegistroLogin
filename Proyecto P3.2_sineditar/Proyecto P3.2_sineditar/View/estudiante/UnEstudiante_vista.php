<?php 
require_once './View/plantilla/encabezado.php';
require_once './View/plantilla/opcion.php';
?>
<div class="container my-3">
    <div class="row justify-content-center align-itmes-center">
        <div class="col-10">
            <div class="card rounded-3 my-3">
                <div class="card-header bg-primary text-center text-light">
                    Todos los datos del estudiante
                </div>
                <div class="card-body align-items-center">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>N°DNI</th><th>Id_Usuario</th>
                                <th>Nombre</th><th>Apellido</th>
                                
                                <th colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $unEstudiante['id_estudiante'] ?></td> 
                                <td><?php echo $unEstudiante['id_user'] ?></td>
                                <td><?php echo $unEstudiante['nombre']; ?></td>
                                <td><?php echo $unEstudiante['apellido']; ?></td>
                                
                                <td><a href="?controller=Estudiante&action=Estudiante_Controlador::editarEstudiante&id=<?php echo $unEstudiante['id_estudiante']; ?>"><i class="fa-solid fa-pen-to-square btnFA"></i></a></td>
                                <td><a href="?controller=Estudiante&action=Estudiante_Controlador::borrarEstudiante&id=<?php echo $unEstudiante['id_estudiante']; ?>"><i class="fa-solid fa-trash btnFA"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>