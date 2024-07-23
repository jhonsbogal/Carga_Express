<?php
class IngresoNomina {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarEmpleado($nombre, $apellido, $cedula, $telefono, $sede, $puesto, $salario, $fechaAfiliacion, $registroEPS, $registroARL, $registroPension) {
        $sql = "INSERT INTO ingreso_a_nomina (nombre, apellido, cedula, telefono, sede, puesto, salario, fecha_afiliacion, registro_eps, registro_arl, registro_pension)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssssdssss", $nombre, $apellido, $cedula, $telefono, $sede, $puesto, $salario, $fechaAfiliacion, $registroEPS, $registroARL, $registroPension);
        
        if ($stmt->execute()) {
            return "Empleado registrado correctamente";
        } else {
            return "Error al registrar empleado: " . $stmt->error;
        }
    }
}
?>
