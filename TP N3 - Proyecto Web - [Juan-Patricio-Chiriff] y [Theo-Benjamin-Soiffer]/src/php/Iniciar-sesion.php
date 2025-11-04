<?php
session_start();
include __DIR__ . '/conexion.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena_usuario'] ?? '';

    if ($nombre_usuario && $contrasena) {
        $stmt = $conexion->prepare("SELECT id_usuario, nombre_usuario,contrasena_usuario, codigo_postal_usuario FROM usuario WHERE nombre_usuario=?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($contrasena, $user['contrasena_usuario'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $user['id_usuario'];
                $_SESSION['usuario_nombre'] = $user['nombre_usuario'];
                $_SESSION['usuario_codigo_postal'] = $user['codigo_postal_usuario'];

                header("Location: ../Crismorena-Grupo[1].php");
                exit;
            
            } else {
                $message = "Usuario o contraseña incorrectos.";
            }
        } else {
            $message = "Usuario o contraseña incorrectos.";
        }
        $stmt->close();
    } else {
        $message = "Todos los campos son obligatorios.";
    }
}
?>