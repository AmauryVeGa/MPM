<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto</title>
  <link rel="stylesheet" href="css/Menu.css">
  <link rel="stylesheet" href="css/Contactos.css">
  <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
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
  
  <div class="container">
    <div class="contact-header">
      <h1>Contáctanos</h1>
      <p>Estamos aquí para ayudarte con todas tus necesidades de transporte</p>
    </div>

    <div class="contact-section">
      <div class="contact-info">
        <div class="info-card">
          <h3>Ubicación</h3>
          <div class="mini-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1612.5717844369317!2d-92.97808165329889!3d18.000009057655475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd70012400ff7%3A0x830908330733984a!2sMPM%20Service!5e0!3m2!1ses!2smx!4v1753974813791!5m2!1ses!2smx" 
                    width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <p class="info-detail">222F+24, RANCHERIA, 86287 Anacleto Canabal 3ra Secc, Tab.</p>
        </div>

        <div class="info-card">
          <h3>Teléfono</h3>
          <p>+52 (993) 123-4567</p>
          <p class="info-detail">Lunes a Domingo: 7:00 AM - 10:00 PM</p>
        </div>

        <div class="info-card">
          <h3>Email</h3>
          <p>info@mpmtransportista.com</p>
          <p class="info-detail">Respuesta en menos de 24 horas</p>
        </div>

        <div class="info-card">
          <h3>Horarios</h3>
          <p>Servicio 24/7</p>
          <p class="info-detail">Reservas online disponibles todo el día</p>
        </div>
      </div>
    </div>

    <div class="map-section">
      <div class="map-container">
        <h2>Nuestra Ubicación</h2>
        <div class="map-frame">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1612.5717844369317!2d-92.97808165329889!3d18.000009057655475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd70012400ff7%3A0x830908330733984a!2sMPM%20Service!5e0!3m2!1ses!2smx!4v1753974813791!5m2!1ses!2smx" 
                  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</body>
</html>