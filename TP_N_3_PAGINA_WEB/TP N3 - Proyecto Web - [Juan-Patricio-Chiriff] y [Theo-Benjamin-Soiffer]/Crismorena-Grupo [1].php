<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Inicio-sesion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></h1>
    <p>Código postal: <?= htmlspecialchars($_SESSION['usuario_codigo_postal']) ?></p>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
