<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mpm");

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login.php");
    exit();
}

if (isset($_POST['id'])) {

    $id = intval($_POST['id']);

    // OPCIONAL: eliminar también la imagen
    $consultaImagen = $conn->prepare("SELECT imagen FROM unidades WHERE te = ?");
    $consultaImagen->bind_param("i", $id);
    $consultaImagen->execute();
    $resultado = $consultaImagen->get_result();
    $fila = $resultado->fetch_assoc();

    if ($fila && !empty($fila['imagen'])) {
        $rutaImagen = "../img/" . $fila['imagen'];
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen); // elimina imagen del servidor
        }
    }

    // Eliminar registro
    $stmt = $conn->prepare("DELETE FROM unidades WHERE te = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../Index.php?");
    } else {
        echo "Error al eliminar.";
    }

    $stmt->close();
}

$conn->close();
?>