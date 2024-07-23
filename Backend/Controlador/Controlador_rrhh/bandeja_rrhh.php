<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/conexion_rrhh.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/bandeja_rrhh.php');

$conexion = new Conexion();
$usuarioModel = new bandeja_rrhh($conexion);


$control = $_POST['control'] ?? '';

switch ($control) {
    case 'buscarUsuario':
        $tipo_identificacion = $_POST['tipo_identificacion'];
        $numero = $_POST['numero'];
        $nombre = $_POST['nombre'];

        $mensaje = $registroContabilidad->buscarUsuario(
            $tipo_identificacion, $numero, $nombre
        );

        echo $mensaje;
        break;

    default:
        echo  "Control no válido";
        break;
}

?>
