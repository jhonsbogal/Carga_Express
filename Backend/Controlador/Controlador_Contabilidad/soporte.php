<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');


require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Contabilidad/conexion_contabilidad.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Contabilidad/soporte.php');

$control = $_GET['control'] ?? '';

$conexion = new Conexion();
$nuevoRegistro = new RegistroContabilidad($conexion->conexion);

switch ($control) {
    case 'registrar':
        // Obtener datos del formulario
        $idCliente = $_POST['idCliente'] ?? '';
        $valorFacturado = $_POST['valorFacturado'] ?? '';
        $metodoPago = $_POST['metodoPago'] ?? '';
        $fechaPago = $_POST['fechaPago'] ?? '';
        $archivo = $_FILES['archivo']['name'] ?? '';

        // Si se ha subido un archivo, moverlo a la ubicación deseada
        if (!empty($archivo)) {
            $destino = '/path/to/upload/directory/' . basename($archivo);
            if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
                echo "Error al subir el archivo.";
                break;
            }
        }

        // Llamar al método para registrar el nuevo registro de contabilidad
        $mensaje = $nuevoRegistro->registrar(
            $idCliente, $valorFacturado, $metodoPago, $fechaPago, $archivo
        );

        echo $mensaje;
        break;
    default:
        echo "Control no válido";
        break;
}
?>