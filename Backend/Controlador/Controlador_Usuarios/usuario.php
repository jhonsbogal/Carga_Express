<?php
// Encabezados CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Incluir archivos
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Usuarios/conexion_usuario.php'); 
require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Usuarios/usuario.php');

// Obtener el control
$control = $_GET['control'] ?? '';

switch ($control) {
    case 'generarYGuardarUsuario':
        // Obtener los datos del formulario
        $tipoIdentificacion = $_POST['tipoIdentificacion'] ?? '';
        $numeroIdentificacion = $_POST['identificacion'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        // Validar datos
        if (empty($tipoIdentificacion) || empty($numeroIdentificacion) || empty($correo) || empty($contrasena)) {
            echo "Todos los campos son obligatorios.";
            break;
        }

        // Crear instancia de la conexión y del modelo de usuario
        $conexion = new Conexion();
        $usuario = new Usuario($conexion);

        // Generar y guardar el usuario
        $mensaje = $usuario->generarYGuardarUsuario($tipoIdentificacion, $numeroIdentificacion, $correo, $contrasena);

        echo $mensaje;
        break;

    case 'modificarDatos':
        // Obtener los datos del formulario
        $correo = $_POST['correo'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        // Validar datos
        if (empty($correo) || empty($contrasena)) {
            echo "Todos los campos son obligatorios.";
            break;
        }

        // Crear instancia de la conexión y del modelo de usuario
        $conexion = new Conexion();
        $usuario = new Usuario($conexion);

        // Modificar los datos del usuario
        $mensaje = $usuario->modificarDatos($correo, $contrasena);

        echo $mensaje;
        break;

    case 'recuperarContrasena':
        // Obtener los datos del formulario
        $correo = $_POST['correo'] ?? '';

        // Validar datos
        if (empty($correo)) {
            echo "El campo de correo es obligatorio.";
            break;
        }

        // Crear instancia de la conexión y del modelo de usuario
        $conexion = new Conexion();
        $usuario = new Usuario($conexion);

        // Recuperar la contraseña del usuario
        $mensaje = $usuario->recuperarContraseña($correo, $contraseña);

        echo $mensaje;
        break;

    case 'eliminarUsuario':
        // Obtener los datos del formulario
        $correo = $_POST['correo'] ?? '';

        // Validar datos
        if (empty($correo)) {
            echo "El campo de correo es obligatorio.";
            break;
        }

        // Crear instancia de la conexión y del modelo de usuario
        $conexion = new Conexion();
        $usuario = new Usuario($conexion);

        // Eliminar el usuario
        $mensaje = $usuario->eliminarUsuario($correo);

        echo $mensaje;
        break;

    default:
        echo "Control no válido";
        break;
}
?>
