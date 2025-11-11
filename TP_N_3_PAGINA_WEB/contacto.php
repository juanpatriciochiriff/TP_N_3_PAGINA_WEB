<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>
  <link rel="stylesheet" href="src/css/contacto.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="#">Productos</a></li>
      </ul>
    </nav>
  </header>

  <h1 class="titulo-principal">Contacto</h1>

  <section class="presencial">
    <h2>Presencial:</h2>
    <div class="contenido-presencial">
      <div class="texto">
        <p>
          Nuestro local presencial ubicado en <b>FLORIDA 357</b><br>
          No tenemos compra mínima y llevando más de 60.000$ hay 10% OFF.
        </p>
      </div>
      <img src="img/local.jpg" alt="Local presencial">
    </div>
  </section>

  <hr>

  <section class="virtual">
    <h2>Virtual:</h2>
    <p>
      Podés pedir online con un mínimo de compra de 50.000 pesos.<br>
      Se despacha a diferentes zonas de capital.<br>
      Hay envío dependiendo la zona a donde se despache el pedido.
    </p>

    <div class="formularios">
      <div class="formulario">
        <h3>Inicio de sesión</h3>
        <form>
          <label>Nombre:</label><br>
          <input type="text"><br>
          <label>Email:</label><br>
          <input type="email"><br>
          <label>Contraseña:</label><br>
          <input type="password"><br>
          <label>Código postal (Costo de envío):</label><br>
          <input type="text">
        </form>
      </div>

      <div class="formulario">
        <h3>Registro</h3>
        <form>
          <label>Nombre:</label><br>
          <input type="text"><br>
          <label>Email:</label><br>
          <input type="email"><br>
          <label>Contraseña:</label><br>
          <input type="password"><br>
          <label>Código postal (Costo de envío):</label><br>
          <input type="text">
        </form>
      </div>
    </div>

    <div class="productos">
      <label>Productos que llevarás:</label><br>
      <textarea></textarea>
    </div>
  </section>

  <section class="promociones">
    <h2>Promociones a fans :3</h2>
    <div class="imagenes-promos">
      <img src="src/img/aliados.png" alt="Aliados">
      <img src="src/img/flikiti.png" alt="Félix stickers">
      <img src="src/img/jugatcontodo.png" alt="Yo soy">
    </div>

    <p>
      Sorteos mensuales y productos GRATIS para nuestros clientes habituales.<br>
      6500$ mensual, 70.000$ anual.
    </p>

    <button class="suscribite">SUSCRIBITE</button>
  </section>

  <footer>
    <p>Copyright © Ludmila Monges 2025 :3</p>
  </footer>
</body>
</html>
