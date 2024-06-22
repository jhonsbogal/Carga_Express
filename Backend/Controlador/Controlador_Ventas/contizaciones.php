<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\conexion_ventas.php'); 
require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\cotizaciones.php');

// Obtener el control
$control = $_GET['control'] ?? '';

// Crear instancia de la conexión y del modelo de cotización
$conexion = new Conexion();
$cotizacion = new Cotizacion($conexion);

// Manejar la solicitud
switch ($control) {
    case 'registrarCotizacion':
        // Obtener los datos del formulario
        $origen = $_POST['origen'] ?? '';
        $destino = $_POST['destino'] ?? '';
        $distancia = $_POST['distancia'] ?? '';
        $peso = $_POST['peso'] ?? '';
        $tipo_mercancia = $_POST['TipoMercancia'] ?? '';

        // Registrar la cotización
        $mensaje = $cotizacion->registrarCotizacion($origen, $destino, $distancia, $peso, $tipo_mercancia);

        echo $mensaje;
        break;
    default:
        echo "Control no válido";
        break;
}

?>
