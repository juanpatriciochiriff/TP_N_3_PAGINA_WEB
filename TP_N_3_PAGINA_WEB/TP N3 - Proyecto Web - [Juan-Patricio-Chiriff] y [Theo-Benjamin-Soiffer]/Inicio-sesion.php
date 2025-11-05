<?php
include __DIR__ . '/src/php/Iniciar-sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="./css/inicio.css">
</head>
<body>
<form action="" method="post">
    <h2>Iniciar Sesión</h2>
    <?= $message ?>
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="nombre_usuario" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <button type="submit" name="boton-sesion">Iniciar sesión</button>

    <p>¿No tenés cuenta? <a href="Registro_usuario.php">Registrate aquí</a></p>
    <p><a href="Crismorena-Grupo[1].php">Entrar sin iniciar sesión</a></p>
</form>
</body>
</html>
