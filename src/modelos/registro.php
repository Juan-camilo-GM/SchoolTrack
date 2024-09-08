<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['usuario_nombre'];
    $apellido = $_POST['usuario_apellido'];
    $email = $_POST['usuario_email'];
    $cedula = $_POST['usuario_cedula'];
    $usuario_rol = (int) $_POST['usuario_rol'];
    $contraseña = password_hash($_POST['usuario_contraseña'], PASSWORD_DEFAULT);
    $fecha_creado = date("Y-m-d H:i:s");
    $origin = $_POST['origin'];  // Capturar el origen

    // Verificar si el email ya está registrado
    $email_check = $conn->prepare("SELECT usuario_email FROM usuario WHERE usuario_email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();

    if ($email_check->num_rows > 0) {
        echo "Este correo ya está registrado";
    } else {
        $sql = "INSERT INTO usuario (usuario_nombre, usuario_apellido, usuario_email, usuario_cedula, usuario_rol, usuario_contraseña, usuario_creado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiss", $nombre, $apellido, $email, $cedula, $usuario_rol, $contraseña, $fecha_creado);

        if ($stmt->execute()) {
            // Redirigir según el origen
            switch($origin) {
                case 'index':
                    header("Location: index.html?status=success");
                    break;
                case 'admin':
                    header("Location: /prueba/src/vistas/gestion-usuario.php?status=success");
                    break;
                default:
                    header("Location: index.html?message=Usuario registrado con éxito");
            }
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $email_check->close();
    $conn->close();
}

?>
