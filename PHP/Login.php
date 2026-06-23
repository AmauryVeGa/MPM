<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mpm");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["usuario"] = $usuario;
         echo "<script>alert('Inicio de Sesión Exitoso. ¡Bienvenido, $usuario!'); window.location.href='../Index.php';</script>";
         exit();
    
    } else {
        echo "<script>alert('Credenciales Incorrectas'); window.location.href='../Login.php';</script>";
        exit(); 
            
    }
    $conn->close();
    header("Location: ../Login.php");
        exit();
}
?>