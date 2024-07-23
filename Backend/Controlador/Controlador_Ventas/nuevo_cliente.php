<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\conexion_ventas.php'); 
require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\nuevo_cliente.php');

// Obtener el control
$control = $_GET['control'] ?? '';

// Crear instancia de la conexión y del modelo de cliente
$conexion = new Conexion();
$newCliente = new nuevo_cliente_($conexion->conexion);

// Manejar la solicitud
switch ($control) {
    case 'registrarCliente':
        // Obtener datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $apellidos = $_POST['apellidos'] ?? '';
        $email = $_POST['email'] ?? '';
        $identificacion = $_POST['identificacion'] ?? '';
        $tipoIdentificacion = $_POST['tipoIdentificacion'] ?? '';

        // Llamar al método para registrar cliente
        $mensaje = $newCliente->registrarCliente($nombre, $apellidos, $email, $identificacion, $tipoIdentificacion);

        echo $mensaje;
        break;
    default:
        echo "Control no válido";
        break;
}
?>

