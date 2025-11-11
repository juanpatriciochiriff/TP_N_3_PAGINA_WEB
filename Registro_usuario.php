<?php include __DIR__ . '/src/php/registro_usuario.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro 343</title>
    <link rel="stylesheet" href="src/css/registro.css">
</head>
<body>
    <div class="container">
        <div class="formulario">
            <h2>Registro de Usuario</h2>
            <?= $message ?>
            <form method="POST" action="">
                <label for="nombre_usuario">Nombre de usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>

                <label for="contrasena_usuario">Contraseña:</label>
                <input type="password" id="contrasena_usuario" name="contrasena_usuario" required>

                <label for="codigo_postal_usuario">Código postal:</label>
                <input type="text" id="codigo_postal_usuario" name="codigo_postal_usuario" required>

                <button type="submit" id="boton">Registrarse</button>
            </form>
            <p>¿Ya tenés cuenta? <a href="Inicio-sesion.php">Iniciar sesión</a></p>
        </div>
    
    </div>
</body>
</html>
