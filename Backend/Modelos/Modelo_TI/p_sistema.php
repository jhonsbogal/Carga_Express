<?php
class Permisos {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function guardarPermisos($idUsuario, $soporteTecnico, $recursosHumanos, $contabilidad, $usuarios, $clientes, $productos, $envios, $observacion) {
        // Verificar si el ID de usuario existe en la tabla usuarios
        $sqlVerificarUsuario = "SELECT * FROM usuario.usuarios WHERE id = ?";
        $stmtVerificar = $this->db->prepare($sqlVerificarUsuario);
        $stmtVerificar->bind_param("i", $idUsuario);
        $stmtVerificar->execute();
        $resultado = $stmtVerificar->get_result();
        $stmtVerificar->close();

        if ($resultado->num_rows === 0) {
            return "Error: El ID de usuario no existe.";
        }

        // Proceder con la inserción en la tabla permisos
        $idUsuario = $this->db->real_escape_string($idUsuario);
        $observacion = $this->db->real_escape_string($observacion);

        $sql = "INSERT INTO permisos (id_usuario, soporte_tecnico, recursos_humanos, contabilidad, usuarios, clientes, productos, envios, observacion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiiiiiiss", $idUsuario, $soporteTecnico, $recursosHumanos, $contabilidad, $usuarios, $clientes, $productos, $envios, $observacion);

        if ($stmt->execute()) {
            $stmt->close(); // Cerrar el statement preparado
            return "Permisos guardados exitosamente";
        } else {
            $stmt->close(); // Cerrar el statement preparado
            return "Error al guardar los permisos: " . $stmt->error;
        }
    }
}
?>
