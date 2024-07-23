<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\conexion_ventas.php'); 
require_once('\xampp\htdocs\cargaexpress\Backend\Modelos\Modelo_Ventas\nuevo_envio.php');

$control = $_GET['control'] ?? '';

$conexion = new Conexion();
$newventa = new nuevo_envio_($conexion->conexion);

switch ($control) {
    case 'registrarEnvio':
        // Obtener datos del formulario
        $NombreEnvia = $_POST['NombreEnvia'] ?? '';
        $tipoIdentificacionEnvia = $_POST['tipoIdentificacionEnvia'] ?? '';
        $NumeroIdentificacionEnvia = $_POST['NumeroIdentificacionEnvia'] ?? '';
        $TelefonoEnvia = $_POST['TelefonoEnvia'] ?? '';
        $DireccionEnvia = $_POST['DireccionEnvia'] ?? '';
        $NombreRecibe = $_POST['NombreRecibe'] ?? '';
        $tipoIdentificacionRecibe = $_POST['tipoIdentificacionRecibe'] ?? '';
        $NumeroIdentificacionRecibe = $_POST['NumeroIdentificacionRecibe'] ?? '';
        $TelefonoRecibe = $_POST['TelefonoRecibe'] ?? '';
        $DireccionRecibe = $_POST['DireccionRecibe'] ?? '';
        $TipoMercancia = $_POST['TipoMercancia'] ?? '';
        $Observaciones = $_POST['Observaciones'] ?? '';

        // Llamar al método para registrar envío
        $mensaje = $newventa->registrarEnvio(
            $NombreEnvia, $tipoIdentificacionEnvia, $NumeroIdentificacionEnvia, $TelefonoEnvia, $DireccionEnvia,
            $NombreRecibe, $tipoIdentificacionRecibe, $NumeroIdentificacionRecibe, $TelefonoRecibe, $DireccionRecibe,
            $TipoMercancia, $Observaciones
        );

        echo $mensaje;
        break;
    default:
        echo "Control no válido";
        break;
}
?>
