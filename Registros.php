<?php
session_start();
require("PHP/Auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Menu.css">
    <link rel="stylesheet" href="css/Registros.css">
    <script src="https://kit.fontawesome.com/eb57cf853c.js" crossorigin="anonymous"></script>
    <title>Servicios</title>
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

<div class="form-container" style="margin-left: 10%">
  <div class="tabs">
    <button onclick="showForm('form1')">Clientes</button>
    <button onclick="showForm('form2')">Servicios</button>
    <button onclick="showForm('form3')">Unidades</button>
  </div>

  <div class="forms">
    <div id="form1" class="form-section" style="display: block;">
         <form class="form ajaxForm" enctype="multipart/form-data">
                <p class="form-title">Registro de Clientes</p>
                <div class="input-container">
                    <input type="hidden" name="tipo" value="cliente">
                    <input type="text" placeholder="Nombre" name="cliente">
                </div>
   
                <div class="input-container">
                    <input type="text" placeholder="Razon Social" name="Rsocial">
                </div>

            <button type="submit" class="submit">
            Registrar
            </button>
         </form>
    </div>

    <div id="form2" class="form-section" style="display: none;">
        <form class="form ajaxForm" enctype="multipart/form-data">
            <p class="form-title">Registro de Servicios</p>
            <div class="input-container">
                <input type="hidden" name="tipo" value="servicio">
                <input type="Nombre" placeholder="Nombre del Servicio" name="refacc">
            </div>
        
            <button type="submit" class="submit">
                Registrar
            </button>
        </form>
    </div>

    <div id="form3" class="form-section" style="display: none;">
         <form class="form ajaxForm" enctype="multipart/form-data">
                <p class="form-title">Registro de Unidades</p>
                <div class="input-container">
                    <input type="hidden" name="tipo" value="unidades">
                    <input type="hidden" name="imagen_url" id="imagen_url">
                    <input type="file" id="imagen" accept="image/*">
                </div>

                <div class="input-container">
                    <input type="number" placeholder="TE" name="te">
                </div>
   
                <div class="input-container">
                    <input type="text" placeholder="Marca" name="marca">
                </div>

                <div class="input-container">
                    <input type="text" placeholder="Modelo" name="modelo">
                </div>

                <div class="input-container">
                    <input type="date" placeholder="Año" name="año">
                </div>

                <div class="input-container">
                    <input type="text" placeholder="Matricula" name="matricula">
                </div>

                <div class="input-container">
                    <input type="text" placeholder="Dueño" name="dueño">
                </div>

            <button type="submit" class="submit">
            Registrar
            </button>
         </form>
    </div>

  </div>
</div>

<script>
  function showForm(formId) {
    const forms = document.querySelectorAll('.form-section');
    forms.forEach(form => {
      form.style.display = 'none';
    });
    const target = document.getElementById(formId);
    if (target) {
      target.style.display = 'block';
    }
  }
</script>
<script type="module">

import { initializeApp }
from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";

import {
    getStorage,
    ref,
    uploadBytes,
    getDownloadURL
}
from "https://www.gstatic.com/firebasejs/12.1.0/firebase-storage.js";

const firebaseConfig = {
    apiKey: "AIzaSyAJlPJmKbwXzsU3mnpu8E-8KjslPe76Eg8",
    authDomain: "proyectoweb-2de6c.firebaseapp.com",
    projectId: "proyectoweb-2de6c",
    storageBucket: "proyectoweb-2de6c.firebasestorage.app",
    messagingSenderId: "316398343540",
    appId: "1:316398343540:web:32495dd5bbd90e6d36c821",
    measurementId: "G-MJPVE98HV3"
  };

const app = initializeApp(firebaseConfig);
const storage = getStorage(app);

document.querySelectorAll(".ajaxForm").forEach(form => {

    form.addEventListener("submit", async function(e){

        e.preventDefault();

        const tipo = this.querySelector(
            "input[name='tipo']"
        ).value;

        if(tipo === "unidades"){

            const archivo =
                document.getElementById("imagen").files[0];

            if(!archivo){
                alert("Seleccione una imagen");
                return;
            }

            try{

                const nombre =
                    Date.now() + "_" + archivo.name;

                const referencia =
                    ref(storage, "unidades/" + nombre);

                await uploadBytes(
                    referencia,
                    archivo
                );

                const url =
                    await getDownloadURL(referencia);

                document.getElementById(
                    "imagen_url"
                ).value = url;

            }catch(error){

                console.error(error);

                alert(
                    "Error al subir imagen a Firebase"
                );

                return;
            }
        }

        const formData = new FormData(this);

        formData.delete("imagen");

        const xhr = new XMLHttpRequest();

        xhr.open(
            "POST",
            "PHP/Registro.php",
            true
        );

        xhr.onreadystatechange = function(){

            if(
                xhr.readyState === 4 &&
                xhr.status === 200
            ){

                let res =
                    JSON.parse(xhr.responseText);

                alert(res.message);

                if(res.status==="success"){
                    location.reload();
                }
            }
        };

        xhr.send(formData);

    });

});

</script>
<script type="module">

import { initializeApp }
from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";

import {
    getStorage,
    ref,
    uploadBytes,
    getDownloadURL
}
from "https://www.gstatic.com/firebasejs/12.1.0/firebase-storage.js";

const firebaseConfig = {
    apiKey: "AIzaSyAJlPJmKbwXzsU3mnpu8E-8KjslPe76Eg8",
    authDomain: "proyectoweb-2de6c.firebaseapp.com",
    projectId: "proyectoweb-2de6c",
    storageBucket: "proyectoweb-2de6c.firebasestorage.app",
    messagingSenderId: "316398343540",
    appId: "1:316398343540:web:32495dd5bbd90e6d36c821",
    measurementId: "G-MJPVE98HV3"
  };

const app = initializeApp(firebaseConfig);

const storage = getStorage(app);

window.storage = storage;
window.refStorage = ref;
window.uploadBytes = uploadBytes;
window.getDownloadURL = getDownloadURL;

</script>
</body>
</html>