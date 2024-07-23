<?php
class CerrarSesion {
    public function cerrarSesion() {
        // Iniciar o reanudar la sesión
        session_start();
        
        // Destruir todas las variables de sesión
        $_SESSION = array();
        
        // Finalmente, destruir la sesión
        session_destroy();
        
        return true; // Indicar que la sesión se cerró correctamente
    }
}
?>
