<?php
session_start();
require("PHP/Auth.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mapa de Sitio</title>
  <link rel="stylesheet" href="css/Menu.css">
  <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
<style>

  .contenedor {
    position: relative;
    width: 1000px;
    height: 600px;
    margin: auto;
  }

  .nodo {
    position: absolute;
    width: 220px;
    height: 130px;
  }

  .nodo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
</head>
<body style="background-color: rgb(39, 39, 39);">

  <div class="container">   
        <div class="sidebar">
          <header><a href="Index.php">MPM Services</a></header>
          <ul>
            <?php if(isset($_SESSION['usuario'])): ?>
            <li><a href="Consulta.php"><i class="fa-solid fa-database"></i>Consultas</a></li>
            <li><a href="Registro_Mantenimiento.php"><i class="fa-solid fa-floppy-disk"></i>Registros</a></li>
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

<div class="contenedor" style="margin-left: 20%">

  <!-- SVG para las líneas -->
  <svg width="1000" height="600" style="position:absolute; top:0; left:0;">
    <!-- Inicio a Contacto -->
    <line x1="500" y1="160" x2="200" y2="320" stroke="#ffffff" stroke-width="2"/>
    
    <!-- Inicio a Servicios -->
    <line x1="500" y1="160" x2="500" y2="320" stroke="#ffffff" stroke-width="2"/>
    
    <!-- Inicio a Acerca de -->
    <line x1="500" y1="160" x2="800" y2="320" stroke="#ffffff" stroke-width="2"/>
  </svg>

  <!-- NODO INICIO -->
  <div class="nodo" style="top:40px; left:390px;">
    <a href="Index.php"><img src="img/Inicio.png" alt="Inicio"></a>
  </div>

  <!-- NODO SERVICIOS -->
  <div class="nodo" style="top:300px; left:90px;">
    <a href="Consulta.php"><img src="img/Consultas.png" alt="Consultas"></a>
  </div>

  <!-- NODO CONTACTO -->
  <div class="nodo" style="top:300px; left:390px;">
    <a href="Registro_Mantenimiento.php"><img src="img/Registros.png" alt="Registros"></a>
  </div>

  <!-- NODO ACERCA DE -->
  <div class="nodo" style="top:300px; left:690px;">
    <a href="Registros.php"><img src="img/Servicios.png" alt="Servicios"></a>
  </div>

</div>

</body>
</html>