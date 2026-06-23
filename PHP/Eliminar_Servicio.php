<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mpm");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login.php");
    exit();
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM servicios WHERE cve_servicios = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../Consulta.php?");
    } else {
        echo "Error al eliminar.";
    }

    $stmt->close();
}

$conn->close();
?>