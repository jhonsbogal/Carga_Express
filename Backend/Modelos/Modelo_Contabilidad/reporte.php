<?php
class reporte {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function obtenerReporte($sede, $idCliente, $fechaInicial, $fechaFinal) {
        $sede = $this->db->real_escape_string($sede);
        $idCliente = $this->db->real_escape_string($idCliente);
        $fechaInicial = $this->db->real_escape_string($fechaInicial);
        $fechaFinal = $this->db->real_escape_string($fechaFinal);

        $sql = "SELECT * FROM reporte_contabilidad 
                WHERE sede = ? 
                AND id_cliente LIKE ? 
                AND fecha_entrega BETWEEN ? AND ?";
        
        $stmt = $this->db->prepare($sql);
        $idCliente = "%$idCliente%";
        $stmt->bind_param("ssss", $sede, $idCliente, $fechaInicial, $fechaFinal);
        $stmt->execute();
        $result = $stmt->get_result();

        $reportes = [];
        while ($row = $result->fetch_assoc()) {
            $reportes[] = $row;
        }
        $stmt->close();

        return $reportes;
    }
}
?>
