<?php 
    require_once './View/plantilla/encabezado.php';
?>

<div class="container my-3">
    <div class="row justify-content-center align-itmes-center">
        <div class="col-8">
            <div class="card rounded-3 my-3">
                <div class="card-header bg-primary text-center text-light">
                    Editando datos de un Estudiante
                </div>
                <?php
                    if ( isset ( $_SESSION['statusEst'] ) ) {
                        // echo $_SESSION['statusOv'];
                    }
                ?>
                <div class="card-body align-items-center">
                    <form action="?controller=Estudiante&action=Estudiante_Controlador::guardarEstudianteEditado" method="post">
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-primary text-light">DNI</span>
                            <input type="number" class="form-control " name="id_estudiante" 
                            value="<?php echo $estudianteEditar['id_estudiante']; ?>"
                            placeholder="DNI del estudiante">
                        </div>    
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-primary text-light">Id_Usuario</span>
                            <input type="number" class="form-control " 
                            value="<?php echo $estudianteEditar['id_estudiante']; ?>"
                            name="id_user" placeholder="Ingrese el id del usuario">
                        </div>
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-primary text-light">Nombre</span>
                            <input type="text" class="form-control" 
                            value="<?php echo $estudianteEditar['nombre']; ?>"
                            name="nombre" placeholder="Ingrese el nombre del estudiante">
                        </div>
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-primary text-light">Apellido</span>
                            <input type="text" class="form-control" 
                            value="<?php echo $estudianteEditar['apellido']; ?>"
                            name="apellido" placeholder="Ingrese el apellido del estudiante">
                        </div>
                        
                        <div class="my-3 mx-auto">
                            <input type="submit" value="Modificar" name="btn-modificar" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>