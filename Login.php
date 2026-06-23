<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/InicioSesion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container" id="container">      
        <div class="form-container sign-in-container">
            <form action="PHP/Login.php" method="post">
                <h1>Iniciar Sesión</h1>
                <span>MPM Socios Transportistas</span>
                <div class="infield">
                    <input type="text" placeholder="Usuario" name="usuario"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Contraseña" name="password" id="password"/>
                    <label></label> 
                </div>
                <button type="submit">Ingresar</button><br>
                <a href="Recuperar_Password.php">¿Has Olvidado la Contraseña?</a>
            </form>
        </div>      
    </div>
</body>
</html>