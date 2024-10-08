<?php 
require_once './View/plantilla/encabezado.php';
require_once './View/plantilla/opcion.php';

?>

<div class="container my-3">
    <div class="row justify-content-center align-itmes-center">
        <div class="col-8">
            <div class="card rounded-3 my-3">
                <div class="card-header bg-success text-center text-light">
                    Ingresando datos de un nuevo Estudiante
                </div>
                <div class="card-body align-items-center">
                    <form action="index.php?controller=Estudiante&action=Estudiante_Controlador::guardarNuevoEstudiante" method="post">
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-black text-light">N° DNI</span>
                            <input type="number" class="form-control " name="id_estudiante" placeholder="Ingrese el número de DNI">
                        </div>
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-black text-light">ID_Usuario</span>
                            <input type="number" class="form-control" name="id_user" placeholder="Ingrese el id de usuario">
                        </div>
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-black text-light">Nombre</span>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del estudiante">
                        </div>
                        <div class="input-group my-3 w-75 mx-auto">
                            <span class="input-group-text bg-black text-light">Apellido</span>
                            <input type="text" class="form-control " name="apellido" placeholder="Ingrese el apellido del estudiante">
                        </div>
                        <div class="my-3 mx-auto">
                            <input type="submit" value="Guardar" name="btn-guardar" class="btn btn-success w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>