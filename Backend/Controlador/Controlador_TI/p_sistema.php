<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/conexion_ti.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_TI/p_sistema.php');

$control = $_GET['control'] ?? '';

switch ($control) {
    case 'guardarPermisos':
        // Obtener los datos del formulario
        $idUsuario = $_POST['idUsuario'] ?? '';
        $soporteTecnico = isset($_POST['soporteTecnico']) ? 1 : 0;
        $recursosHumanos = isset($_POST['recursosHumanos']) ? 1 : 0;
        $contabilidad = isset($_POST['contabilidad']) ? 1 : 0;
        $usuarios = isset($_POST['usuarios']) ? 1 : 0;
        $clientes = isset($_POST['clientes']) ? 1 : 0;
        $productos = isset($_POST['productos']) ? 1 : 0;
        $envios = isset($_POST['envios']) ? 1 : 0;
        $observacion = $_POST['observacion'] ?? '';

        // Crear instancia de la conexión y del modelo de permisos
        $conexion = new Conexion();
        $permisos = new Permisos($conexion);

        // Guardar los permisos
        $mensaje = $permisos->guardarPermisos($idUsuario, $soporteTecnico, $recursosHumanos, $contabilidad, $usuarios, $clientes, $productos, $envios, $observacion);

        echo $mensaje;
        break;
    
    default:
        echo "Control no válido";
        break;
}
?>
