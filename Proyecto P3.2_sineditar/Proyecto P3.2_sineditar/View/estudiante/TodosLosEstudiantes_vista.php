<?php 
require_once './View/plantilla/encabezado.php';
require_once './View/plantilla/opcion.php';

?>
<div class="container my-3">
    <div class="row justify-content-center align-itmes-center">
        <div class="col-10">
            <div class="card rounded-3 my-3">
                <div class="card-header bg-primary text-center text-light">
                    Todos los datos de los estudiantes
                </div>
                <div class="card-body align-items-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- encabezados -->
                                <th>N°DNI</th><th>ID_Usuario</th>
                                <th>Nombre</th><th>Apellido</th>
                                <th colspan="2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($todosLosEstudiantes as $item) {
                                // $raza = Raza_Modelo::buscarRazaPorID($item['id_raza']);
                            ?>
                                <tr>
                                    <td><?php echo $item['id_estudiante'] ?></td> 
                                    <td><?php echo $item['id_user'] ?></td>
                                    <td><?php echo $item['nombre']; ?></td>
                                    <td><?php echo $item['apellido']; ?></td>
                                    
                                    
                                    <!-- lista de valores que se toman de la tabla -->
                                    <td><a href="?controller=Estudiante&action=Estudiante_Controlador::editarEstudianteo&id_estudiante=<?php echo $item['id_estudiante']; ?>"><i class="fa-solid fa-pen-to-square btnFA"></i></a></td>
                                    <td><a href="?controller=Estudiante&action=Estudiante_Controlador::borrarEstudiante&id_estudiante=<?php echo $item['id_estudiante']; ?>"><i class="fa-solid fa-trash btnFA"></a></td>
                                </tr>
                            <?php }; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>