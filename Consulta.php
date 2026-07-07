<?php
   session_start(); // Inicia la sesión
   require("PHP/Auth.php");

$conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

   if (isset($_SESSION['usuario'])) { // Verifica si la sesión está iniciada y la variable de usuario existe
       $nombre_usuario = $_SESSION['usuario']; // Obtiene el nombre de usuario de la sesión
   } else {
       $nombre_usuario = "usuario"; // Valor por defecto si no hay sesión iniciada
   }

$sql = "SELECT 
            s.cve_servicios,
            u.te,
            s.kilometraje,
            s.costo,
            s.folio_factura,
            s.fecha_servicio,
            s.descripcion,
            c.Nombre_cliente,
            d.Nombre_dueño,
            r.nombre

        FROM servicios s
        JOIN unidades u ON s.te = u.te
        JOIN cliente c ON s.cve_cliente = c.cve_cliente
        JOIN dueño d ON s.cve_dueño = d.cve_dueño
        JOIN refacciones r ON s.cve_refacciones = r.cve_refacciones";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/Tabla_Consulta.css">
    <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
    <title>Consultas</title>
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
    <div class="container">
    <h1 class="titulo" style="margin-left: 10%">Ultimos Servicios Registrados</h1>
    <div class="tabla">

    <label for="text" maxlength="20" style="color: white;">Buscar:</label>
   <input type="search" name="" id="Buscador">

       <?php

       if ($result->num_rows > 0) {
    echo "<table id='tablaServicios' border='1'>
            <tr>
                <th>Unidad</th>
                <th>Kilometraje</th>
                <th>Cliente</th>
                <th>Refacción</th>
                <th>Descripcion</th>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Costo</th>
                <th>Dueño</th>
                <th>Acción</th>               
            </tr>";

    // Mostrar los datos fila por fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["te"] . "</td>
                <td>" . $row["kilometraje"] . "</td>
                <td>" . $row["Nombre_cliente"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["descripcion"] . "</td>
                <td>" . $row["folio_factura"] . "</td>
                <td>" . $row["fecha_servicio"] . "</td>
                <td>$" . number_format($row["costo"], 2) . "</td>
                <td>" . $row["Nombre_dueño"] . "</td>
        <td>
            <form action='PHP/Eliminar_Servicio.php' method='POST'
                    onsubmit=\"return confirm('¿Eliminar este servicio?');\">
                <input type='hidden' name='id' value='" . $row["cve_servicios"] . "'>
                <button type='submit' 
                    style='background:red;color:white;border:none;padding:5px 10px;cursor:pointer;'>
                    Eliminar
                </button>
            </form>
        </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No hay servicios registrados.";
}

?>

</div>
</div>
</body>
</html>

<script>
    document.getElementById("Buscador").addEventListener("keyup", function() {
        let filtro = this.value.toLowerCase();
        let tabla = document.getElementById("tablaServicios");
        let filas = tabla.getElementsByTagName("tr");

        for (let i = 1; i < filas.length; i++) { // Empieza en 1 para saltar el encabezado
            let fila = filas[i];
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? "" : "none";
        }
    });
</script>