<?php
class Liquidacion {
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
        $stmt->bind_param("sss", $tipoIdentificacion, $numero, $nombre);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $usuarios = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $usuarios;
        } else {
            $stmt->close();
            return ["error" => "Error en la consulta: " . $stmt->error];
        }
    }

    public function liquidarEmpleado($tipo_identificacion, $numero, $nombre, $salario, $eps, $rangoEPS, $arl, $rangoARL, $fondoPension, $horasExtras) {
        $tipoIdentificacion = $this->db->real_escape_string($tipo_identificacion);
        $numero = $this->db->real_escape_string($numero);
        $nombre = $this->db->real_escape_string($nombre);
        $salario = $this->db->real_escape_string($salario);
        $eps = $this->db->real_escape_string($eps);
        $rangoEPS = $this->db->real_escape_string($rangoEPS);
        $arl = $this->db->real_escape_string($arl);
        $rangoARL = $this->db->real_escape_string($rangoARL);
        $fondoPension = $this->db->real_escape_string($fondoPension);
        $horasExtras = $this->db->real_escape_string($horasExtras);

        $sql = "UPDATE liquidar_empleado SET salario_actual = ?, eps = ?, rango_eps = ?, arl = ?, rango_arl = ?, fondo_pensiones = ?, horas_extras = ? WHERE tipo_identificacion = ? AND numero_identificacion = ? AND nombre LIKE ?";
        $stmt = $this->db->prepare($sql);
        $nombre = "%$nombre%";
        $stmt->bind_param("dsssssssss", $salario, $eps, $rangoEPS, $arl, $rangoARL, $fondoPension, $horasExtras, $tipoIdentificacion, $numero, $nombre);
        
        if ($stmt->execute()) {
            $stmt->close();
            return ["mensaje" => "Empleado liquidado exitosamente"];
        } else {
            $stmt->close();
            return ["error" => "Error al liquidar el empleado: " . $stmt->error];
        }
    }
}
?>
