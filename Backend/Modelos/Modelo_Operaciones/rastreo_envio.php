<?php
class Envios {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function buscarEnvio($tipoBusqueda, $numero) {
        $numero = $this->db->real_escape_string($numero);
        
        // Validar el tipo de búsqueda
        switch ($tipoBusqueda) {
            case 'ID Cliente':
                $campo = 'id_cliente';
                break;
            case 'Identificación':
                $campo = 'identificacion';
                break;
            case 'ID Guía':
                $campo = 'id_guia';
                break;
            default:
                return "Tipo de búsqueda no válido.";
        }

        $sql = "SELECT id_guia, fecha_envio, estado, tipo_mercancia, conductor_asignado, ubicacion 
                FROM r_envios 
                WHERE $campo = ?";
        
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return "Error en la preparación de la consulta: " . $this->db->error;
        }

        $stmt->bind_param("s", $numero);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $envios = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $envios;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error en la ejecución de la consulta: " . $error;
        }
    }
}
?>