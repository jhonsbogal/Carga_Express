<?php
class Usuario {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->getConnection();
    }

    public function generarYGuardarUsuario($tipoIdentificacion, $numeroIdentificacion, $correo, $contraseña) {
        $tipoIdentificacion = $this->db->real_escape_string($tipoIdentificacion);
        $numeroIdentificacion = $this->db->real_escape_string($numeroIdentificacion);
        $correo = $this->db->real_escape_string($correo);
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT); // Aquí usamos $contraseña

        $sql = "INSERT INTO usuarios (tipo_identificacion, numero_identificacion, correo, contraseña) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $tipoIdentificacion, $numeroIdentificacion, $correo, $contraseña);

        if ($stmt->execute()) {
            $stmt->close();
            return "Usuario creado exitosamente";
        } else {
            $stmt->close();
            return "Error al crear el usuario: " . $stmt->error;
        }
    }

    public function modificarDatos($correo, $contraseña) {
        $correo = $this->db->real_escape_string($correo);
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT); // Aquí usamos $contraseña

        $sql = "UPDATE usuarios SET contraseña=? WHERE correo=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $contraseña, $correo);

        if ($stmt->execute()) {
            $stmt->close();
            return "Datos modificados exitosamente";
        } else {
            $stmt->close();
            return "Error al modificar los datos: " . $stmt->error;
        }
    }

    public function recuperarContraseña($correo, $contraseña) {
        $correo = $this->db->real_escape_string($correo);

        $sql = "SELECT contraseña FROM usuarios WHERE correo=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            $stmt->bind_result($contraseña);
            if ($stmt->fetch()) {
                $stmt->close();
                return "La contraseña es: " . $contraseña;
            } else {
                $stmt->close();
                return "Usuario no encontrado";
            }
        } else {
            $stmt->close();
            return "Error al recuperar la contraseña: " . $stmt->error;
        }
    }

    public function eliminarUsuario($correo) {
        $correo = $this->db->real_escape_string($correo);

        $sql = "DELETE FROM usuarios WHERE correo=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            $stmt->close();
            return "Usuario eliminado exitosamente";
        } else {
            $stmt->close();
            return "Error al eliminar el usuario: " . $stmt->error;
        }
    }
}
?>
