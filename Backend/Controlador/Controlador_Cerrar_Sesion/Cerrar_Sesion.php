<?php
session_start(); // Iniciar la sesión si no está iniciada

require_once('/xampp/htdocs/cargaexpress/Backend/Modelos/Modelo_Cerrar_Sesion/Cerrar_Sesion.php');

$modeloCerrarSesion = new CerrarSesion();

$control = $_GET['control'] ?? '';

switch ($control) {
    case 'cerrarSesion':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['accion']) && $_POST['accion'] === 'cerrar_sesion') {
                // Llamar al método para cerrar sesión
                if ($modeloCerrarSesion->cerrarSesion()) {
                    // Redireccionar a la página de inicio de sesión u otra página deseada
                    header('Location: /cargaexpress/index.php'); // Ajusta la URL según tu estructura
                    exit();
                } else {
                    echo "Error al cerrar sesión";
                }
            } else {
                echo "Acción no válida";
            }
        } else {
            echo "Método de solicitud no válido. Se requiere POST.";
        }
        break;

    // Otros casos para diferentes acciones
    default:
        echo 'Control no válido';
        break;
}
?>