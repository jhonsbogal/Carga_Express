<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/conexion_ti.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/bandeja.php');

// Obtener el control
$control = $_GET['control'] ?? '';

switch ($control) {
    case 'crearRequerimiento':
        // Obtener los datos del formulario
        $numero_ticket = $_POST['numero_ticket'] ?? '';
        $observaciones = $_POST['observaciones'] ?? '';

        // Crear instancia de la conexión y del modelo de nuevo_ticket
        $conexion = new Conexion();
        $nuevo_ticket = new bandeja_ticket($conexion);

        // Crear y guardar el requerimiento
        $mensaje = $nuevo_ticket->crearRequerimiento($numero_ticket, $observaciones);

        echo $mensaje;
        break;
    
    case 'obtenerRequerimientos':
        // Crear instancia de la conexión y del modelo de nuevo_ticket
        $conexion = new Conexion();
        $nuevo_ticket = new bandeja_ticket($conexion);

        // Obtener los requerimientos
        $requerimientos = $nuevo_ticket->obtenerRequerimientos();

        // Devolver como JSON
        header('Content-Type: application/json');
        echo json_encode($requerimientos);
        break;
    
    default:
        echo "Control no válido";
        break;
}
?>
