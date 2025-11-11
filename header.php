<?php
session_start();
?>
<link rel="stylesheet" href="src/css/header.css">
<header>
  <nav>
    <ul>
     
      <div class="left-space"></div>

     
      <div class="center-menu">
      <li><a href="TP-N3-Proyecto Web-[Chiriff-juanpatricio]-[Theo-soiffer].php">Inicio</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="#">Productos</a></li>
      </div>

      <div class="right-menu">
        <?php if (isset($_SESSION['id_usuario'])): ?>
          <li><a href="/php/cerrar-sesion.php">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="Inicio-sesion.php">Iniciar sesión</a></li>
        <?php endif;?>
      </div>
    </ul>
  </nav>
</header>

