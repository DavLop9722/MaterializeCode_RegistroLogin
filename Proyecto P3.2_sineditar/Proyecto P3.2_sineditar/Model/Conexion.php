<?php
    class Conexion extends PDO {
        private $host = 'localhost';
        private $typeBD = 'mysql';
        private $nameBD = 'tablaprueba';
        private $usr = 'root';
        private $pass = '';

        public function __construct() {
            try {
                parent::__construct("{$this->typeBD}:dbname={$this->nameBD};host={$this->host};
                charset=utf8", $this->usr, $this->pass);
            } catch (PDOException $e) {
                echo "Error en la conexión a la base de datos ".$e->getMessage();
            }
        }
    }
?>