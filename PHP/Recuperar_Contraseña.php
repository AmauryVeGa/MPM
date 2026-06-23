<?php
$conn = new mysqli("localhost", "root", "", "mpm");

$email = $_POST["email"];

if (empty($email)) {
    echo "<script>
            alert('Todos los campos son obligatorios');
            window.location.href='../Recuperar_Password.php';
          </script>";
    exit();
}

$stmt = $conn->prepare("SELECT cv_usuario FROM usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>
            alert('El email no existe');
            window.location.href='../Recuperar_Password.php';
          </script>";
    exit();
}

$stmt = $conn->prepare("SELECT usuario, password FROM usuario WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$contra = $result->fetch_assoc();

echo "<script>alert('Usuario: ".$contra['usuario']."   Contraseña: ".$contra['password']."');window.location.href='../Recuperar_Password.php';</script>";