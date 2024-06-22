<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/conexion_ti.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/nuevo_ticket.php');

// Obtener el control
$control = $_GET['control'] ?? '';

switch ($control) {
    case 'guardarRequerimiento':
        // Obtener los datos del formulario
        $observaciones = $_POST['observaciones'] ?? '';

        // Crear instancia de la conexión y del modelo de soporte
        $conexion = new Conexion();
        $soporte = new nuevo_ticket($conexion);

        // Guardar el requerimiento
        $mensaje = $soporte->guardarRequerimiento($observaciones);

        echo $mensaje;
        break;

    default:
        echo "Control no válido";
        break;
}
?>
