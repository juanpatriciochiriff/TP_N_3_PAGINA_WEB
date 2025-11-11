<?php
session_start();
include __DIR__ . '/../db/conexion.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($nombre_usuario && $contrasena) {
        $stmt = $conexion->prepare("SELECT id_usuario, nombre_usuario, contrasena_usuario, codigo_postal_usuario FROM usuario WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($contrasena, $user['contrasena_usuario'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $user['id_usuario'];
                $_SESSION['usuario_nombre'] = $user['nombre_usuario'];
                

                header("Location: /TP_N_3_PAGINA_WEB/TP N3 - Proyecto Web - [Juan-Patricio-Chiriff] y [Theo-Benjamin-Soiffer]/Crismorena-Grupo[1].php");
                exit;
            } else {
                $message = "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
            }
        } else {
            $message = "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
        }
        $stmt->close();
    } else {
        $message = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
    }
}
?>
