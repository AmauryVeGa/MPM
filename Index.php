<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MPM Socios Transportistas de Villahermosa</title>
    <link rel="stylesheet" href="css/Menu.css">

    <link rel="stylesheet" href="css/Tabla_Consulta.css">

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
  <h1 class="titulo" style="margin-left: 10%">Unidades en Renta</h1>
<?php
$conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

$sql = "SELECT * FROM unidades";

$resultado = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($resultado)){
?>
 <?php if(isset($_SESSION['usuario'])): ?>
    <div class="card-unidad">
        <img src="<?php echo $row['imagen']; ?>" width="200">
        <p><strong>Año:</strong> <?php echo $row['año']; ?></p>
        <p><strong>Matrícula:</strong> <?php echo $row['matricula']; ?></p>
        <form action='PHP/Eliminar_Unidad.php' method='POST'
                    onsubmit="return confirm('¿Eliminar este servicio?');">
                <input type="hidden" name="id" value="<?php echo $row['TE']; ?>">
                <button type='submit' 
                    style='background:red;color:white;border:none;padding:5px 10px;cursor:pointer;'>
                    Eliminar
                </button>
            </form>
    </div>
    <?php else: ?>
      <div class="card-unidad">
        <img src="<?php echo $row['imagen']; ?>" width="200">
        <p><strong>Año:</strong> <?php echo $row['año']; ?></p>
        <p><strong>Matrícula:</strong> <?php echo $row['matricula']; ?></p>
    </div>
    <?php endif; ?>
<?php
}
?>
  </body>
</html>