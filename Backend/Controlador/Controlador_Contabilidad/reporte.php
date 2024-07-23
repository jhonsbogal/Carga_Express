<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Contabilidad/conexion_contabilidad.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Contabilidad/reporte.php');

$conexion = new Conexion();
$modeloReporte = new reporte($conexion);

$resultados = [];
$mensajeError = '';

$control = $_GET['control'] ?? '';

switch ($control) {
    case 'obtenerReporte':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sede = $_POST['sede'] ?? '';
            $idCliente = $_POST['idCliente'] ?? '';
            $fechaInicial = $_POST['fechaInicial'] ?? '';
            $fechaFinal = $_POST['fechaFinal'] ?? '';

            $resultados = $modeloReporte->obtenerReporte($sede, $idCliente, $fechaInicial, $fechaFinal);
            if (is_string($resultados)) {
                $mensajeError = $resultados; // En caso de error, $resultados contendrá el mensaje de error
                $resultados = [];
            }
        } else {
            $mensajeError = 'Método de solicitud no válido. Se requiere POST.';
        }
        break;
    // Otros casos para diferentes acciones
    default:
        $mensajeError = 'Control no válido';
        $resultados = [];
        break;
}

if (!empty($mensajeError)) {
    echo $mensajeError;
} else {
    echo json_encode($resultados);
}
?>