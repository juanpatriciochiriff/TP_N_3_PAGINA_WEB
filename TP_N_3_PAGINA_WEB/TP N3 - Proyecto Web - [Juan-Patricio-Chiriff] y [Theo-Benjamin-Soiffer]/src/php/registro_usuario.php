<?php
session_start();
include __DIR__ . '/../db/conexion.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $codigo_postal = trim($_POST['codigo_postal_usuario'] ?? '');
    $contrasena = $_POST['contrasena_usuario'] ?? '';

    if ($nombre_usuario && $codigo_postal && $contrasena) {
        $check = $conexion->prepare("SELECT id_usuario FROM usuario WHERE nombre_usuario = ?");
        $check->bind_param("s", $nombre_usuario);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "<p style='color:red;'>El usuario ya existe.</p>";
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("INSERT INTO usuario (nombre_usuario, contrasena_usuario, codigo_postal_usuario) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre_usuario, $hash, $codigo_postal);

            if ($stmt->execute()) {
                header("Location: inicio-sesion.php");
                exit;
            } else {
                $message = "<p style='color:red;'>Error al registrar el usuario.</p>";
            }
            $stmt->close();
        }
        $check->close();
    } else {
        $message = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}
?>
