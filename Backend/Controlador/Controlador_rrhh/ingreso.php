<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/conexion_rrhh.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/ingreso.php');

$control = $_GET['control'] ?? '';

$conexion = new Conexion();
$ingresoNomina = new IngresoNomina($conexion->conexion);

switch ($control) {
    case 'registrarEmpleado':
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $cedula = $_POST['cedula'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $puesto = $_POST['puesto'] ?? '';
        $salario = $_POST['salario'] ?? '';
        $fechaAfiliacion = $_POST['fechaAfiliacion'] ?? '';
        $registroEPS = $_POST['registroEPS'] ?? '';
        $registroARL = $_POST['registroARL'] ?? '';
        $registroPension = $_POST['registroPension'] ?? '';

        $mensaje = $ingresoNomina->registrarEmpleado(
            $nombre, $apellido, $cedula, $telefono, $sede, $puesto, $salario, $fechaAfiliacion, $registroEPS, $registroARL, $registroPension
        );

        echo $mensaje;
        break;
    
    default:
        echo "Control no válido";
        break;
}
?>
