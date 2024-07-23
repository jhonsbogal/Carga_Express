<?php
class Conexion {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "operaciones";
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }
    public function getConnection() {
        return $this->conexion;
    }
}
?>
