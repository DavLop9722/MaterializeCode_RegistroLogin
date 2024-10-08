<?php

class Conexion {
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $db = 'gestion_escolar';
    private $user = 'root';
    private $pass = '';

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Conexion();
        }
        return self::$instance->conn;
    }
}
?>
