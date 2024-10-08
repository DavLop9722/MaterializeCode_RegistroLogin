<?php require_once "encabezado.php"; ?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-2">
            <a href="?controller=Estudiante&action=Estudiante_Controlador::nuevoEstudiante" class="btn btn-success">Nuevo Estudiante</a>
        </div>
        <div class="col-8 justify-content-center">
            <div class="input-group my-3 w-75 mx-auto">
                <span class="input-group-text bg-primary text-light">N° Registro </span>
                <input type="number" class="form-control " name="id_estudiante" id="id_estudiante"
                placeholder="Identificador del estudiante">
                <a href="#" class="btn btn-primary" onclick="editarIndicado()">Buscar</a>
            </div>
        </div>
    </div>
</div>