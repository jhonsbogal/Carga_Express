<?php
class Inventario {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function registrarMovimiento($producto, $cantidad, $tipoMovimiento) {
        $producto = $this->db->real_escape_string($producto);
        $cantidad = intval($cantidad);
        $tipoMovimiento = $this->db->real_escape_string($tipoMovimiento);

        // Determinar la cantidad ajustada según el tipo de movimiento
        $cantidadAjustada = ($tipoMovimiento === 'Entrada') ? $cantidad : -$cantidad;

        // Registrar el movimiento en la tabla de movimientos
        $sql = "INSERT INTO inventario (producto, cantidad, tipo_movimiento) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return "Error en la preparación de la consulta: " . $this->db->error;
        }
        $stmt->bind_param("sis", $producto, $cantidadAjustada, $tipoMovimiento);

        if ($stmt->execute()) {
            $stmt->close();
            // Actualizar las existencias del producto en la tabla de inventario
            $sql = "UPDATE inventario SET existencias = existencias + ? WHERE producto = ?";
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                return "Error en la preparación de la consulta: " . $this->db->error;
            }
            $stmt->bind_param("is", $cantidadAjustada, $producto);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return "Error en la ejecución de la consulta: " . $stmt->error;
            }
        } else {
            $stmt->close();
            return "Error en la ejecución de la consulta: " . $stmt->error;
        }
    }

    public function obtenerExistencias($producto) {
        $producto = $this->db->real_escape_string($producto);
        $sql = "SELECT existencias FROM inventario WHERE producto = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return "Error en la preparación de la consulta: " . $this->db->error;
        }
        $stmt->bind_param("s", $producto);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $existencias = $result->fetch_assoc();
            $stmt->close();
            return $existencias['existencias'];
        } else {
            $stmt->close();
            return "Error en la ejecución de la consulta: " . $stmt->error;
        }
    }
}
?>