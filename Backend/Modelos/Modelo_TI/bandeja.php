<?php
require_once('conexion_ti.php');

class bandeja_ticket {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function obtenerRequerimientos() {
        $sql = "SELECT id, fecha, numero_ticket, observaciones FROM bandeja";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $tickets = array();
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $row;
            }
            return $tickets;
        } else {
            return [];
        }
    }

    public function crearRequerimiento($numero_ticket, $observaciones) {
        $fecha = date('Y-m-d');
        $numero_ticket = $this->db->real_escape_string($numero_ticket);
        $observaciones = $this->db->real_escape_string($observaciones);

        $sql = "INSERT INTO bandeja (fecha, numero_ticket, observaciones) 
                VALUES ('$fecha', '$numero_ticket', '$observaciones')";
        
        if ($this->db->query($sql) === TRUE) {
            return "Requerimiento creado exitosamente";
        } else {
            return "Error al crear el requerimiento: " . $this->db->error;
        }
    }
}
?>
