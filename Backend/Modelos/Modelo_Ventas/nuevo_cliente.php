<?php
class nuevo_cliente_ {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrarCliente($nombre, $apellidos, $email, $identificacion, $tipoIdentificacion) {
        // Escapar caracteres especiales en una cadena para usarla en una consulta SQL
        $nombre = $this->db->real_escape_string($nombre);
        $apellidos = $this->db->real_escape_string($apellidos);
        $email = $this->db->real_escape_string($email);
        $identificacion = $this->db->real_escape_string($identificacion);
        $tipoIdentificacion = $this->db->real_escape_string($tipoIdentificacion);

        $sql = "INSERT INTO nuevo_cliente (nombre, apellidos, email, identificacion, tipoIdentificacion) 
                VALUES ('$nombre', '$apellidos', '$email', '$identificacion', '$tipoIdentificacion')";

        if ($this->db->query($sql) === TRUE) {
            return "Nuevo cliente creado exitosamente";
        } else {
            return "Error: " . $sql . "<br>" . $this->db->error;
        }
    }
}
?>
