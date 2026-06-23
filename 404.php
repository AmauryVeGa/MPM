<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Página no encontrada</title>
  <link rel="stylesheet" href="css/Menu.css"> 
  <link rel="stylesheet" href="css/Error.css">
  <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: rgb(39, 39, 39);">

  <div class="container">   
        <div class="sidebar">
          <header><a href="Index.php">MPM Services</a></header>
          <ul>
            <?php if(isset($_SESSION['usuario'])): ?>
            <li><a href="Consulta.php"><i class="fa-solid fa-database"></i>Consultas</a></li>
            <li><a href="Registro_mantenimiento.php"><i class="fa-solid fa-floppy-disk"></i>Registros</a></li>
            <li><a href="Registros.php"><i class="fa-solid fa-table"></i>Services</a></li>
            <li><a href="Sitemap.php"><i class="fa-regular fa-map"></i>Sitemap</a></li>
            <li><a href="Usuarios.php"><i class="fa-solid fa-circle-user"></i>Perfiles </a></li>
       
            <li><a href="#"><form action="PHP/Logout.php" method="post" style="margin: 0;">
              <button type="submit" style="background: none; border: none; color: inherit; padding: 0; font: inherit; cursor: pointer;">
                <i class="fa-solid fa-arrow-down"></i> Cerrar Sesión
              </button>
            </form></a></li>
             <?php else: ?>
              <li><a href="Contactos.php"><i class="fa-solid fa-address-book"></i>Contactos</a></li>
              <li><a href="Login.php"><i class="fa-solid fa-arrow-down"></i>Iniciar Sesión</a></li>
             <?php endif; ?>
          </ul>  
        </div> 
  </div>

  <div class="error-container">
    <div class="error-content">
      <h1>404</h1>
      <h2>¡Ups! Ruta no encontrada</h2>
      <p>Parece que la página que intentas visitar no existe o ha sido movida.</p>
      
    </div>
  </div>

</body>
</html>