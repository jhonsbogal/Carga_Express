<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Operaciones/conexion_operaciones.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Operaciones/inventario.php');

$conexion = new Conexion();
$modeloInventario = new Inventario($conexion);

// Obtener el parámetro de control
$control = $_GET['control'] ?? '';

switch ($control) {
    case 'registrar_movimiento':
        // Obtener datos del formulario
        $producto = $_GET['producto'] ?? '';
        $cantidad = $_GET['cantidad'] ?? '';
        $tipoMovimiento = $_GET['tipoMovimiento'] ?? '';

        // Validar campos requeridos
        if (empty($producto) || empty($cantidad) || empty($tipoMovimiento)) {
            echo "Todos los campos son obligatorios.";
            exit();
        }

        // Registrar movimiento y mostrar resultado
        $resultado = $modeloInventario->registrarMovimiento($producto, $cantidad, $tipoMovimiento);
        if (is_string($resultado)) {
            echo $resultado; // Mostrar mensaje de error si ocurre
        } else {
            // Obtener existencias actuales y mostrar mensaje
            $existencias = $modeloInventario->obtenerExistencias($producto);
            echo "Movimiento registrado correctamente. Existencias actuales: $existencias";
        }
        break;

    default:
        echo "Control no válido";
        break;
}
?>