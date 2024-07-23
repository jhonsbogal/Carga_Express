<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Operaciones/conexion_operaciones.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Operaciones/rastreo_envio.php');

$control = $_GET['control'] ?? '';

$conexion = new Conexion();
$modeloEnvios = new Envios($conexion);

$resultados = [];
$mensajeError = '';

switch ($control) {
    case 'buscarEnvio':
        // Obtener datos del formulario
        $tipoBusqueda = $_GET['tipoBusqueda'] ?? '';
        $numero = $_GET['numero'] ?? '';

        $resultados = $modeloEnvios->buscarEnvio($tipoBusqueda, $numero);
        if (is_string($resultados)) {
            $mensajeError = $resultados; // En caso de error, $resultados contendrá el mensaje de error
            $resultados = [];
        }
        break;

    default:
        $mensajeError = 'Control no válido';
        break;
}

// Mostrar resultados o mensaje de error
if (!empty($mensajeError)) {
    echo $mensajeError;
} else {
    echo '<pre>';
    print_r($resultados);
    echo '</pre>';
}
?>