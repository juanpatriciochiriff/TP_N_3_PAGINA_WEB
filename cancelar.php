<?php
session_start();

// 1. Redirigir al login si no hay sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Inicio-sesion.php");
    exit;
}

// 2. Incluir conexión a la base de datos
// NOTA: Asegúrate de que este archivo define la variable $conexion correctamente.
require_once "src/db/conexion.php";

$id_usuario = $_SESSION['id_usuario'];
$mensaje_exito = "";
$redirigir = false;


// 3. Lógica para procesar la cancelación
if (isset($_GET["action"]) && $_GET["action"] === "confirmar_cancelacion") {

    // Consulta para cambiar el estado de suscripción a inactivo
    $sql = "UPDATE usuario 
            SET suscrito = 0, tipo_suscripcion = NULL 
            WHERE id_usuario = ?";
    // Se usa $conexion
    $stmt = $conexion->prepare($sql);
    
    // Verificación de la preparación (buena práctica)
    if ($stmt === false) {
        // Se usa $conexion
        error_log("Error al preparar la consulta de cancelación: " . $conexion->error);
        $mensaje_exito = "Ocurrió un error al procesar tu solicitud. Intenta más tarde.";
    } else {
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            $mensaje_exito = "Tu suscripción ha sido cancelada con éxito.<br>Aún podés disfrutar de tus beneficios hasta el final del ciclo de pago.";
            $redirigir = true;
            $stmt->close();
        } else {
            error_log("Error al ejecutar la cancelación: " . $stmt->error);
            $mensaje_exito = "Error de base de datos al cancelar. Contactá a soporte.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Suscripción</title>
    <link rel="stylesheet" href="src/css/metodo-pago.css">
    <link rel="icon" type="image/png" href="src/img/icono.png"> 
</head>

<body>

<div class="contenedor-pago">

    <?php if ($mensaje_exito): ?>
        <div class="mensaje-exito" style="border: 2px solid #f39c12;">
            <h2>👋 ¡Cancelación Procesada!</h2>
            <p><?= $mensaje_exito ?></p>
            <p style="font-size: 0.9rem; color: #666;">Serás redirigido al inicio en unos segundos...</p>
        </div>

        <?php if ($redirigir): ?>
        <script>
            setTimeout(() => {
                window.location.href = 'Index.html';
            }, 5000); // Redirigimos 5 segundos después para que pueda leer el mensaje
        </script>
        <?php endif; ?>

    <?php else: ?>
        <!-- VISTA DE PRE-CONFIRMACIÓN (Antes de cancelar) -->
        <h1 class="titulo-principal">Administrar Suscripción</h1>

        <div class="plan-elegido" style="background-color: #fcebeb; color: #e74c3c;">
            ⚠️ ¿Estás seguro/a que querés cancelar?
        </div>

        <p style="margin-bottom: 25px; color: #777;">
            Al cancelar, perderás los descuentos y el acceso a sorteos exclusivos una vez finalizado tu ciclo de pago.
        </p>

        <div class="opciones" style="flex-direction: column;">
            
            <!-- Botón de Confirmación -->
            <a class="opcion" href="cancelar.php?action=confirmar_cancelacion" style="background-color: #e74c3c; color: white;">
                ❌ SÍ, QUIERO CANCELAR MI SUSCRIPCIÓN
            </a>
            
            <!-- Botón de Volver -->
            <a class="opcion" href="suscripcion.php" style="background-color: #ccc; margin-top: 10px;">
                Regresar a la página de planes
            </a>
        </div>
        
    <?php endif; ?>

</div>

</body>
</html>