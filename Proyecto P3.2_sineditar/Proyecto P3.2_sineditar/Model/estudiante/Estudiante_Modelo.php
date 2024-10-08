<?php

    require_once "../../Config/Database.php";

    session_start();

    class Estudiante_Modelo extends UserModel{
        private $id_user;
        private $dni;
        private $nombre;
        private $apellido;

        const EST_TABLE = 'estudiante';

        public function __construct($dni, $id_user, $nombre, $apellido)
        {
            $this->dni = $dni;
            $this->id_user = $id_user;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            
        }

        public function getIdEstudiante(){
            return $this->dni;
        }
        public function getIdUser(){
            return $this->id_user;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function serIdUser($id_user){
            $this->id_user = $id_user;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }

        public function editar_guardar_est(){
            $conn = new Database();

            if ($this->dni){
                $sql = 'UPDATE'. self::EST_TABLE.'SET id = :dni,
                                                        user_id = :id_user,
                                                        nombre = :nombre,
                                                        apellido = :apellido

                                                        WHERE id = dni
                                                    ';
                
                $query = $this->prepare($sql);
                $query->bindParam(':dni', $this->dni);
                $query->bindParam(':id_user', $this->id_user);
                $query->bindParam(':nombre', $this->nombre);
                $query->bindParam(':apellido', $this->apellido);

                $query->execute();

                $_SESSION['StatusEst'] = 'El registro de estudiante se agregó correctamente';
                
            }
            $con = null;
        }

        public static function todos_los_estudiantes(){
            $conn = new Database();

            $sql = 'SELECT * FROM'. self::EST_TABLE.'ORDER BY apellido';

            $query = $conn->prepare($sql);
            $query->execute();

            $todosLosEstudiantes = $query->fetchAll();

            return $todosLosEstudiantes;

            $con = null;
        }

        public static function buscar_estudiante_dni($dni){
            $con = new Database();

            $sql = 'SELECT * FROM'.self::EST_TABLE.'WHERE id = :dni';
            $query = $con->prepare($sql);
            $query->bindParam(':dni', $dni);

            $query->execute();

            $unEstudiante = $query->fetch();

            if ($unEstudiante){
                return $unEstudiante;
            } else {
                $_SESSION['StatusEst'] = 'El DNI ingresado no es valido';
            }
            
            $con = null;
        }

        public static function borrar_estudiante_dni($dni){
            $con = new Database();

            $sql = 'DELETE FROM'.self::EST_TABLE.'WHERE id = :dni';

            $query = $con->prepare($sql);
            $query->bindParam(':dni',$dni);
            $query->execute();

            $registro = $query->rowCount();
            return $registro;

            $con = null;
        }
    }



?>