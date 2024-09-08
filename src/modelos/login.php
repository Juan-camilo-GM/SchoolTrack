<?php
include '../../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['usuario_email'];
    $contraseña = $_POST['usuario_contraseña'];

    $sql = "SELECT id, usuario_contraseña FROM usuario WHERE usuario_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_contraseña);
    $stmt->fetch();

    if ($id && password_verify($contraseña, $hashed_contraseña)) {
        $_SESSION['user_id'] = $id;
        header("Location: ../vistas/noticias.html");
        exit();
    } else {
        header("Location: index.html?error=incorrect_credentials");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
