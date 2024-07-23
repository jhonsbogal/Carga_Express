<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/conexion_rrhh.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_rrhh/liquidacion.php');

$conexion = new Conexion();
$usuarioModel = new liquidacion($conexion);

$control = $_GET['control'] ?? '';

switch ($control) {
    case 'buscar':
        $tipo_identificacion = $_POST['tipoIdentificacion'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $nombre = $_POST['nombre'] ?? '';

        $resultados = $usuarioModel->buscarUsuario($tipo_identificacion, $numero, $nombre);
        echo "<pre>";
        print_r($resultados);
        echo "</pre>";
        break;

    case 'liquidar':
        $tipo_identificacion = $_POST['tipo_identificacion'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $salario = $_POST['salario'] ?? null;
        $eps = $_POST['eps'] ?? null;
        $rangoEPS = $_POST['rangoEPS'] ?? null;
        $arl = $_POST['arl'] ?? null;
        $rangoARL = $_POST['rangoARL'] ?? null;
        $fondoPension = $_POST['fondoPension'] ?? null;
        $horasExtras = $_POST['horasExtras'] ?? null;

        $resultados = $usuarioModel->liquidarEmpleado($tipo_identificacion, $numero, $nombre, $salario, $eps, $rangoEPS, $arl, $rangoARL, $fondoPension, $horasExtras);
        
        if (isset($resultados['mensaje'])) {
            echo $resultados['mensaje'];
        } else {
            echo $resultados['error'];
        }
        break;

    default:
        echo "Control no válido";
        break;
}
?>
