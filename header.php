<?php session_start(); ?>
<link rel="stylesheet" href="src/css/header.css">

<header class="header">

  <input type="checkbox" id="menu-toggle">

  <label for="menu-toggle" class="hamburger">
      <span></span>
      <span></span>
      <span></span>
  </label>

  <nav>
    <ul>

      <div class="left-space"></div>

      <div class="center-menu">
        <li><a href="Index.html">Inicio</a></li>
        <li><a href="contacto.html">Contacto</a></li>
        <li><a href="productos.html">Productos</a></li>
      

      
        <?php if (isset($_SESSION['id_usuario'])): ?>
          <li><a href="src/php/cerrar-sesion.php">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="Inicio-sesion.php">Iniciar sesión</a></li>
        <?php endif; ?>
      </div>

    </ul>
  </nav>

</header>
