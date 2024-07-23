<?php
class nuevo_ticket{
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->conexion;
    }

    public function guardarRequerimiento($observaciones) {
        $observaciones = $this->db->real_escape_string($observaciones);

        $sql = "INSERT INTO nuevo_ticket (observaciones) VALUES ('$observaciones')";

        if ($this->db->query($sql) === TRUE) {
            return "Requerimiento guardado exitosamente";
        } else {
            return "Error al guardar el requerimiento: " . $this->db->error;
        }
    }
}
?>
