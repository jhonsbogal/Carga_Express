<?php
class bandeja_rrhh {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function buscarUsuario($tipo_identificacion, $numero, $nombre) {
        $tipoIdentificacion = $this->db->real_escape_string($tipo_identificacion);
        $numero = $this->db->real_escape_string($numero);
        $nombre = $this->db->real_escape_string($nombre);

        $sql = "SELECT sede, fecha_ingreso, cargo, tipo_contrato, salario_actual, periodo_pagar, registro_horas_extras_mensual, salario_mes, fecha_pago 
                FROM registro_talento_humano 
                WHERE tipo_identificacion = ? AND numero_identificacion = ? AND nombre LIKE ?";

        $stmt = $this->db->prepare($sql);
        $nombre = "%$nombre%";
        $stmt->bind_param("sss", $tipo_identificacion, $numero, $nombre);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $usuarios;
        } else {
            $stmt->close();
            return "Error en la consulta: " . $stmt->error;
        }
    }
}
?>
