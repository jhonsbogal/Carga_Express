<?php
class RegistroContabilidad {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($idCliente, $valorFacturado, $metodoPago, $fechaPago, $archivo) {
        $query = "INSERT INTO registros_contabilidad (id_cliente, valor_facturado, metodo_pago, fecha_pago, archivo) 
                  VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->conexion->prepare($query)) {
            $stmt->bind_param("sssss", $idCliente, $valorFacturado, $metodoPago, $fechaPago, $archivo);

            if ($stmt->execute()) {
                return "Registro creado exitosamente";
            } else {
                return "Error al crear el registro: " . $stmt->error;
            }
        } else {
            return "Error al preparar la consulta: " . $this->conexion->error;
        }
    }
}
?>
