<?php
   session_start();
   require("PHP/Auth.php");
$conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

$result_te = $conn->query("SELECT TE FROM unidades ORDER BY TE ASC");

$result_refac = $conn->query("SELECT cve_refacciones, nombre FROM refacciones");

$result_cliente = $conn->query("SELECT cve_cliente, nombre_cliente FROM cliente");

$result_dueño = $conn->query("SELECT cve_dueño, Nombre_dueño From dueño");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Registro_Mantenimento.css">
    <link rel="stylesheet" href="css/Menu.css">
    <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
    <title>Registros</title>
</head>
<body>

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

    <div class="carta">

        <div class="formulario">
            <div class="titulo">
                    <h1>Registro de Mantenimientos</h1>
            </div>
            <form id="formMant" class="form-container">

            <label for="">Numero Economico</label>
                  <select name="te" id="te">
                          <option value="">Seleccione la Unidad</option>
                            <?php
                                if ($result_te->num_rows > 0) {
                                    while($row = $result_te->fetch_assoc()) {
                                        echo "<option value='"  . htmlspecialchars($row["TE"]) . "'>" . htmlspecialchars($row["TE"]) . "</option>";
                                    }
                                }
                          ?>
                    </select>

            <label for="">Dueño</label>
            <select name="cve_dueño" id="cve_dueño">
                <option value="">Seleccione el Dueño</option>
                   <?php
                                if ($result_dueño->num_rows > 0) {
                                    while($row = $result_dueño->fetch_assoc()) {
                                        echo "<option value='"  . htmlspecialchars($row["cve_dueño"]) . "'>" . htmlspecialchars($row["Nombre_dueño"]) . "</option>";
                                    }
                                }
                          ?>
                
            </select>
       
          <label>Kilometraje</label> 
          <input type="text" name="kilometraje" placeholder="Kilometraje Actual">

           <label for="">Cliente</label>
            <select name="cve_cliente" id="cve_cliente">
                <option value="">Seleccione el Cliente</option>
              <?php while ($c = $result_cliente->fetch_assoc()) { ?>
                  <option value="<?= $c['cve_cliente'] ?>"><?= $c['nombre_cliente'] ?></option>
              <?php } ?>
            </select>

                   <label for="">Refacciones</label>
                <select name="cve_refacciones" id="cve_refacciones">
                    <option value="">Seleccione la Refacción</option>
                    <?php while ($r = $result_refac->fetch_assoc()) { ?>
                        <option value="<?= $r['cve_refacciones'] ?>"><?= $r['nombre'] ?></option>
                    <?php } ?>
                </select>

                <label for="">Descripción</label>
                <input type="text" name="descrip" placeholder="Descripción del Servicio" maxlength="300">

                <label for="">Costo</label>
                <input type="text" name="precio" placeholder="Costo"><br>
            
                <label for="">Folio</label>
                <input type="text" name="folio" placeholder="Folio de Factura"> <br>
                    
                <label for="">Fecha</label>
                <input type="date" name="fecha" placeholder="Fecha del Servicio">

                <div class="botones">
                   <input type="submit" value="Registrar"></input>
                </div>             
    </form>             
    </div>
    </div>
    </div>
    <script>
document.getElementById("formMant").addEventListener("submit", function(e){
    e.preventDefault(); // Evita que recargue la página

    var form = document.getElementById("formMant");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "PHP/Registro_Mant.php", true);

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            try {
                var respuesta = JSON.parse(xhr.responseText);
                
                if(respuesta.status === "success"){
                    alert(respuesta.message);
                    window.location.href = "Consulta.php";
                } else {
                    alert(respuesta.message);
                }

            } catch(error){
                alert("Error en la respuesta del servidor");
            }
        }
    };

    xhr.send(formData);
});
</script>
</body>
</html>