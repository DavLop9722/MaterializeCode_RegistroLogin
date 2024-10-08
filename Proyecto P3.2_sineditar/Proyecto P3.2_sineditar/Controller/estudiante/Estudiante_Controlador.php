<?php 
    require_once './Model/estudiante/Estudiante_Modelo.php';

    class Estudiante_Controlador{

        public static function mostrarEstudiantes(){
            $todosLosEstudiantes = Estudiante_Modelo::todos_los_estudiantes();

            require_once './View/estudiante/TodosLosEstudiantes_vista.php';
        }
        public static function mostrarUnEstudiante(){
            if (isset($_GET['id_estudiante'])) {

                $id = $_GET['id_estudiante'];

                $unEstudiante = Estudiante_Modelo::buscar_estudiante_dni($id);

                if ($unEstudiante){
                    require_once './View/estudiante/UnEstudiante_vista.php';
                }
            }

        }

        public static function guardarNuevoEstudiante(){
            if (isset($_POST['btn-guardar'])){
                $id_estudiante = $_POST['id_estudiante'];
                $id_user = $_POST['user_id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];

                $nuevoestudiante = new Estudiante_Modelo($id_estudiante,
                                                        $id_user,
                                                        $nombre,
                                                        $apellido);

                $nuevoestudiante->editar_guardar_est();
            }
            Estudiante_Controlador::mostrarEstudiantes();
        }

        public static function editarEstudiante(){
            if (!isset($_GET['id_estudiante'])){
                exit;
            }
            $id = $_GET['id_estudiante'];

            $editarEstidiante = Estudiante_Modelo::buscar_estudiante_dni($id);

            require_once './View/estudiante/EditarEstudiante_vista.php';
        }

        public static function guardarEstudianteEditado(){
            if (isset($_POST['btn-modificar'])){
                $id_estudiante = $_POST['id_estudiante'];
                $id_user = $_POST['user_id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];

                $nuevoestudiante = new Estudiante_Modelo($id_estudiante,
                                                        $id_user,
                                                        $nombre,
                                                        $apellido);
                
                $nuevoestudiante->editar_guardar_est();

            }
            Estudiante_Controlador::mostrarEstudiantes();
        }
        
        public static function borrarEstudiante(){
            if (!isset($_GET['id_estudiante'])){
                exit;
            }
            $id = $_GET['id_estudiante'];

            $nroRegistro = Estudiante_Modelo::buscar_estudiante_dni($id);

            if ( isset ( $_POST['btn-borrar'] ) ) {
                if ( $nroRegistro > 0 ) {
                    echo "El registro no pudo ser borrado";
                } 
            }
            Estudiante_Controlador::mostrarEstudiantes();

        }
    }
?>