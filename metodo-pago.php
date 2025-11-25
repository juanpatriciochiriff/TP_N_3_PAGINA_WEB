<?php
session_start();



if (!isset($_SESSION['id_usuario'])) {
    header("Location: Inicio-sesion.php");
    exit;
}

include __DIR__ . "/src/db/conexion.php";

$mensaje_exito = "";
$redirigir = false;
$total_compra = $_GET["total"] ?? null;

if (isset($_GET["confirmar"]) && isset($_GET["plan"])) {

    $plan = $_GET["plan"];
    $id = $_SESSION["id_usuario"];


    $sql = "UPDATE usuario 
            SET suscrito = 1, tipo_suscripcion = ? 
            WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $plan, $id);

    if ($stmt->execute()) {
        $mensaje_exito = "¡Pago procesado con éxito!<br>Gracias por unirte a la comunidad.";
        $redirigir = true;
    }
}

$plan = $_GET["plan"] ?? "mensual";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <link rel="stylesheet" href="src/css/metodo-pago.css">
</head>

<body>

<div class="contenedor-pago">

    <?php if ($mensaje_exito): ?>
        <div class="mensaje-exito">
            <div style="font-size: 3rem;">🎉</div>
            <h2 style="color: #d16aa3;">¡Bienvenido/a!</h2>
            <p><?= $mensaje_exito ?></p>
            <p style="font-size: 0.9rem; color: #666; margin-top: 20px;">
                Te estamos redirigiendo al inicio...
            </p>
        </div>

        <?php if ($redirigir): ?>
        <script>
            // Redirige después de 3 segundos
            setTimeout(() => {
                window.location.href = 'Index.html';
            }, 3000);
        </script>
        <?php endif; ?>

    <?php else: ?>
        <div id="vista-seleccion">
            <h1 class="titulo-principal">Método de Pago</h1>

            <div class="plan-elegido">
    <?php if ($total_compra): ?>
        🛒 Total de tu compra: <strong>$<?= number_format($total_compra, 0, ',', '.') ?></strong>
    <?php elseif ($plan === "anual"): ?>
        💎 Plan Anual <strong>$70.000</strong>
    <?php else: ?>
        📅 Plan Mensual <strong>$6.500</strong>
    <?php endif; ?>
</div>

            <p style="margin-bottom: 20px; color: #777;">Seleccioná cómo querés abonar:</p>

            <div class="opciones">
                <a class="opcion" href="metodo-pago.php?plan=<?= $plan ?>&confirmar=1" onclick="mostrarCarga()">
                    💳 Tarjeta de crédito / débito
                </a>
                <a class="opcion" href="metodo-pago.php?plan=<?= $plan ?>&confirmar=1" onclick="mostrarCarga()">
                    🤝 Mercado Pago
                </a>
                <a class="opcion" href="metodo-pago.php?plan=<?= $plan ?>&confirmar=1" onclick="mostrarCarga()">
                    🏦 Transferencia bancaria
                </a>
                <a class="opcion" href="metodo-pago.php?plan=<?= $plan ?>&confirmar=1" onclick="mostrarCarga()">
                    🧾 Pago Fácil / Rapipago
                </a>
            </div>
            
            <div style="margin-top: 25px;">
                <a href="suscripcion.php" style="color: #aaa; text-decoration: none; font-size: 0.9rem;">Cancelar y volver</a>
            </div>
        </div>

        <div id="vista-carga" class="loader-container">
            <div class="spinner"></div>
            <h3 style="color: #555;">Procesando pago...</h3>
            <p style="color: #999; font-size: 0.9rem;">Por favor no cierres la página.</p>
        </div>

        <script>
            // Función simple para ocultar opciones y mostrar spinner
            function mostrarCarga() {
                document.getElementById('vista-seleccion').style.display = 'none';
                document.getElementById('vista-carga').style.display = 'block';
            }
        </script>

    <?php endif; ?>

</div>

</body>
</html>