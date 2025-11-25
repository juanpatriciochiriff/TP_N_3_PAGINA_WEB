<?php
session_start();

// 1. Redirigir al login si no hay sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Inicio-sesion.php");
    exit;
}

// 2. Incluir conexión a la base de datos
// NOTA: Asegúrate de que este archivo define la variable $conn correctamente.
require_once "src/db/conexion.php";

$id_usuario = $_SESSION['id_usuario'];
$esta_suscrito = false;
$tipo_suscripcion = null;

// 3. Consultar el estado de suscripción del usuario
$sql_usuario = "SELECT suscrito, tipo_suscripcion FROM usuario WHERE id_usuario = ?";
$stmt_usuario = $conexion->prepare($sql_usuario);

if ($stmt_usuario) {
    $stmt_usuario->bind_param("i", $id_usuario);
    $stmt_usuario->execute();
    $result_usuario = $stmt_usuario->get_result();

    if ($result_usuario->num_rows === 1) {
        $usuario = $result_usuario->fetch_assoc();
        if ($usuario['suscrito'] == 1) {
            $esta_suscrito = true;
            $tipo_suscripcion = $usuario['tipo_suscripcion'];
        }
    }
    $stmt_usuario->close();
} else {
    
    error_log("Error al preparar la consulta de suscripción: " . $conexion>"error");
}


function traducir_plan($plan) {
    return ($plan === 'anual') ? 'Anual' : 'Mensual';
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suscripción Fans Cris Morena</title>
  <link rel="stylesheet" href="src/css/suscripcion.css">
  <script src="src/js/header-y-footer.js"></script>
</head>

<body>
  <div id="header"></div>

  <h1 class="titulo-principal">Comunidad Cris Morena</h1>

  <section class="suscripcion">
    
    <?php if ($esta_suscrito): ?>
      
        <h2>¡Ya sos parte del mundo mágico!</h2>

        <div class="suscrito-info">
            <p class="descripcion" style="margin-bottom: 30px;">
                Felicidades, ya estás suscrito al <b>Plan <?= traducir_plan($tipo_suscripcion) ?></b>.
                Disfrutá de todos tus beneficios exclusivos, descuentos y sorteos.
            </p>

            <div class="plan plan-activo">
                <h3>Plan Activo: <?= traducir_plan($tipo_suscripcion) ?></h3>
                <p class="precio" style="color: #2ecc71;">✅ ACTIVA</p>
                <p>Tu suscripción se renovará automáticamente.</p>
                
                <!-- Botón de cancelación (requiere nueva lógica en un archivo 'cancelar.php') -->
                <a href="cancelar.php" class="btn-cancelar" style="margin-top: 20px;">
                    ADMINISTRAR / CANCELAR SUSCRIPCIÓN
                </a>
                
                <p style="margin-top: 15px; font-size: 0.8rem; color: #999;">
                    Si cancelás, tus beneficios seguirán activos hasta el final del ciclo de pago.
                </p>
            </div>
        </div>

    <?php else: ?>
        <!-- VISTA DE PLANES (USUARIO NO SUSCRITO) -->
        <h2>Elegí tu pase al mundo mágico</h2>

        <p class="descripcion">
          Sumate para acceder a <b>productos exclusivos</b>, <b>descuentos especiales</b>,  
          <b>sorteos mensuales</b> y contenido único de nuestros favoritos: Aliados, Floricienta,  
          Rebelde Way, Chiquititas y más.
        </p>

        <div class="planes">
          <!-- PLAN MENSUAL -->
          <div class="plan">
            <h3>Mensual</h3>
            <p class="precio">$6.500 <span style="font-size:1rem; font-weight:normal; color:#777">/mes</span></p>
            <ul>
              <li>10% OFF en todos los productos</li>
              <li>Sorteos mensuales exclusivos</li>
              <li>Acceso a preventas limitadas</li>
            </ul>
            <a href="metodo-pago.php?plan=mensual" class="btn-comprar">QUIERO ESTE</a>
          </div>

          <!-- PLAN ANUAL (DESTACADO) -->
          <div class="plan destacado">
            <div class="etiqueta-destacado">Mejor Opción</div>
            
            <h3>Anual</h3>
            <p class="precio">$70.000 <span style="font-size:1rem; font-weight:normal; color:#777">/año</span></p>
            <ul>
              <li><b>20% OFF</b> en toda la tienda</li>
              <li>🎁 Productos sorpresa de regalo</li>
              <li>Participación <b>doble</b> en sorteos</li>
              <li>Acceso VIP a eventos</li>
            </ul>
            <a href="metodo-pago.php?plan=anual" class="btn-comprar">QUIERO ESTE</a>
          </div>
        </div>

    <?php endif; ?>
    
  </section>

  <div id="footer"></div>
</body>
</html>