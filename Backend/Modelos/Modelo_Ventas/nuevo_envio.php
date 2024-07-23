<?php
class nuevo_envio_ {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarEnvio($NombreEnvia, $tipoIdentificacionEnvia, $NumeroIdentificacionEnvia, $TelefonoEnvia, $DireccionEnvia,
                                   $NombreRecibe, $tipoIdentificacionRecibe, $NumeroIdentificacionRecibe, $TelefonoRecibe, $DireccionRecibe,
                                   $TipoMercancia, $Observaciones) {
        $sql = "INSERT INTO nuevo_envio (NombreEnvia, tipoIdentificacionEnvia, NumeroIdentificacionEnvia, TelefonoEnvia, DireccionEnvia,
                                         NombreRecibe, tipoIdentificacionRecibe, NumeroIdentificacionRecibe, TelefonoRecibe, DireccionRecibe,
                                         TipoMercancia, Observaciones)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        if ($stmt === false) {
            return "Error al preparar la consulta: " . $this->conexion->error;
        }
        $stmt->bind_param("ssssssssssss", $NombreEnvia, $tipoIdentificacionEnvia, $NumeroIdentificacionEnvia, $TelefonoEnvia, $DireccionEnvia,
                                           $NombreRecibe, $tipoIdentificacionRecibe, $NumeroIdentificacionRecibe, $TelefonoRecibe, $DireccionRecibe,
                                           $TipoMercancia, $Observaciones);

        if ($stmt->execute()) {
            return "Nuevo envío registrado exitosamente";
        } else {
            return "Error: " . $this->conexion->error;
        }
    }
}
?>
