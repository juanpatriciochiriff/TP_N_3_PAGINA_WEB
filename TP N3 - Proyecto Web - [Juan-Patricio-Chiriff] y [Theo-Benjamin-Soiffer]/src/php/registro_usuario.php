<?php
session_start();

include __DIR__ . '/../db/conexion.php';

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $contrasena = $_POST['contrasena_usuario'] ?? '';
    $codigo_postal_usuario = trim($_POST['codigo_postal_usuario'] ?? '');

    // 4. Buscar el id del equipo según el nombre ingresado
    $stmt = $conn->prepare("SELECT id_equipo FROM equipo WHERE nombre = ?");
    $stmt->bind_param("s", $nombre_equipo);
    $stmt->execute();
 

    if ($nombre_usuario && $contrasena && $codigo_postal_usuario) {

        
        $check = $conn->prepare("SELECT id_usuario FROM usuario WHERE nombre_usuario = ?");
        $check->bind_param("s", $nombre_usuario);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "<p style='color:red;text-align:center;'>El usuario ya existe.</p>";
        } else {
            
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (nombre_usuario, contrasena,codigo_postal_usuario) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nombre_usuario, $hash, $codigo_postal_usuario);

            if ($stmt->execute()) {
                header("Location: ../html-extra/Inicio-sesion.php"); 
                exit;
            } else {
                $message = "<p style='color:red;text-align:center;'>Error al registrar usuario.</p>";
            }
            $stmt->close();
        }
        $check->close();
    } else {
        $message = "<p style='color:red;text-align:center;'>Todos los campos son obligatorios y el equipo debe ser válido.</p>";
    }
}

$conn->close();
?>

