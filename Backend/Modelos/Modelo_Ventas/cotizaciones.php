<?php
class Cotizacion {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function registrarCotizacion($origen, $destino, $distancia, $peso, $tipo_mercancia) {
        $origen = $this->db->real_escape_string($origen);
        $destino = $this->db->real_escape_string($destino);
        $distancia = (int)$distancia;
        $peso = (int)$peso;
        $tipo_mercancia = $this->db->real_escape_string($tipo_mercancia);

        $sql = "INSERT INTO cotizaciones (origen, destino, distancia, peso, tipo_mercancia) 
                VALUES ('$origen', '$destino', $distancia, $peso, '$tipo_mercancia')";

        if ($this->db->query($sql) === TRUE) {
            return "Cotización creada exitosamente";
        } else {
            return "Error: " . $sql . "<br>" . $this->db->error;
        }
    }
}
?>
