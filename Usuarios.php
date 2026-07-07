<?php
session_start();
require("PHP/Auth.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MPM Socios Transportistas de Villahermosa</title>
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/Tabla_Consulta.css">
    <link rel="stylesheet" href="css/Usuarios.css">

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
  <h1 class="titulo" style="margin-left: 10%">Agregar Usuario</h1>
  <div class="contenedor-form">
    <div class="form-box">
  <form class="ajaxForm">
    <input type="hidden" name="tipo" value="registro_usuario">
    <input type="text" name="usuario" placeholder="Usuario"><br><br>
    <input type="password" name="password" placeholder="Contraseña"><br><br>
    <input type="email" name="email" placeholder="Correo"><br><br>
    <button type="submit">Registrar</button>
  </form>
    </div>
  </div>
  <h1 class="titulo" style="margin-left: 10%">Actualizar Usuario</h1>
  <div class="contenedor-form">
    <div class="form-box">
  <form class="ajaxForm">
    <input type="hidden" name="tipo" value="actualizar_usuario">
    <input type="text" name="usuario" placeholder="Usuario"><br><br>
    <input type="text" name="nuevo_usuario" placeholder="Nuevo Usuario"><br><br>
    <input type="password" name="password" placeholder="Nueva Contraseña"><br><br>
    <button type="submit">Actualizar</button>
  </form>
    </div>
  </div>
  <h1 class="titulo" style="margin-left: 10%">Ver/Borrar Usuario</h1>
  <div class="contenedor-form">
    <div class="form-box">
      <?php
      $conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

      $result = $conn->query("SELECT cv_usuario, usuario FROM usuario");
      ?>
    <?php while($row = $result->fetch_assoc()) { ?>
        <div class="usuario">
            <span><?php echo $row["usuario"]; ?></span>

            <form class="ajaxForm">
                <input type="hidden" name="tipo" value="borrar_usuario">
                <input type="hidden" name="id" value="<?php echo $row["cv_usuario"]; ?>">
                <button style="background: red; color:white" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                Eliminar
                </button>
            </form>
        </div>
    <?php } ?>
    </div>
  </div>
<script>
document.querySelectorAll(".ajaxForm").forEach(form => {

    form.addEventListener("submit", function(e){
        e.preventDefault();

        let formData = new FormData(this);
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "PHP/Usuarios_AJAX.php", true);

        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                try {
                    let res = JSON.parse(xhr.responseText);

                    if(res.status === "success"){
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }

                } catch(error){
                    alert("Error en la respuesta del servidor");
                }
            }
        };

        xhr.send(formData);
    });

});
</script>
  </body>
</html>