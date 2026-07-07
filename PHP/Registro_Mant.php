<?php
session_start();
$conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $campos_requeridos = ["te", "kilometraje", "folio", "precio", "fecha", "descrip", "cve_cliente", "cve_refacciones", "cve_dueño"];
    
    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            echo json_encode([
                "status" => "error",
                "message" => "Todos los campos son obligatorios"
            ]);
            exit();
        }
    }

    $NumeroEco  = $conn->real_escape_string($_POST["te"]);
    $kilometraje = $conn->real_escape_string($_POST["kilometraje"]);
    $cliente    = $conn->real_escape_string($_POST["cve_cliente"]);
    $refaccion  = $conn->real_escape_string($_POST["cve_refacciones"]);
    $folio      = $conn->real_escape_string($_POST["folio"]);
    $precio     = $conn->real_escape_string($_POST["precio"]);
    $fecha      = $conn->real_escape_string($_POST["fecha"]);
    $dueño      = $conn->real_escape_string($_POST["cve_dueño"]);
    $descripcion =$conn->real_escape_string($_POST["descrip"]);

    $sql = "INSERT INTO servicios 
        (TE, kilometraje, costo, folio_factura, fecha_servicio, Descripcion, cve_cliente, cve_dueño, cve_refacciones) 
        VALUES 
        ('$NumeroEco', '$kilometraje', '$precio', '$folio', '$fecha', '$descripcion', '$cliente', '$dueño', '$refaccion')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "status" => "success",
            "message" => "Servicio de la unidad $NumeroEco registrado con éxito!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Error al registrar: " . $conn->error
        ]);
    }

    $conn->close();
}
?>