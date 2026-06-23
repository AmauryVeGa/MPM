<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/InicioSesion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container" id="container">      
        <div class="form-container sign-in-container">
            <form action="PHP/Recuperar_Contraseña.php" method="post">
                <h1>Recuperar Contraseña</h1>
                <span>MPM Socios Transportistas</span>
                <div class="infield">
                    <input type="email" name="email" placeholder="Correo"><br><br>                    
                    <label></label>
                </div>
                <button type="submit">Mostrar Contraseña</button><br>
                <a href="Login.php">Volver</a>
            </form>
        </div>      
    </div>
</body>
</html>