<?php
session_start();
$conn = new mysqli("fdb1029.awardspace.net", "4773432_mpm", "VeGaAmaury09", "4773432_mpm");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo = $_POST["tipo"];

    /* =============================
       REGISTRO DE CLIENTE
    ============================= */
    if ($tipo == "cliente") {

        $cliente = $_POST["cliente"];
        $razon = $_POST["Rsocial"];

        if (empty($cliente) || empty($razon)) {
            echo json_encode(["status"=>"error","message"=>"Todos los campos son obligatorios"]);
            exit();
        }

        $sql = "INSERT INTO cliente (Nombre_cliente, Razon_Social)
                VALUES ('$cliente', '$razon')";

        if ($conn->query($sql)) {
            echo json_encode(["status"=>"success","message"=>"Cliente registrado con éxito"]);
        } else {
            echo json_encode(["status"=>"error","message"=>$conn->error]);
        }

        exit();
    }

    /* =============================
       REGISTRO DE SERVICIO
    ============================= */
    if ($tipo == "servicio") {

        $refacc = $_POST["refacc"];

        if (empty($refacc)) {
            echo json_encode(["status"=>"error","message"=>"Todos los campos son obligatorios"]);
            exit();
        }

        $sql = "INSERT INTO refacciones(nombre) VALUES ('$refacc')";

        if ($conn->query($sql)) {
            echo json_encode(["status"=>"success","message"=>"Servicio registrado con éxito"]);
        } else {
            echo json_encode(["status"=>"error","message"=>$conn->error]);
        }

        exit();
    }

    /* =============================
       REGISTRO DE UNIDADES
    ============================= */
    if ($tipo == "unidades") {

        $TE = $_POST["te"];
        $Año = $_POST["año"];
        $Matricula = $_POST["matricula"];
        $Marca = $_POST["marca"];
        $Modelo = $_POST["modelo"];
        $Dueño = $_POST["dueño"];

        if (empty($TE) || empty($Año) || empty($Matricula) || empty($Marca) || empty($Modelo) || empty($Dueño)) {
            echo json_encode(["status"=>"error","message"=>"Todos los campos son obligatorios"]);
            exit();
        }

        // ✅ VALIDACIÓN: verificar si el TE ya existe
        $check = $conn->query("SELECT * FROM unidades WHERE TE = '$TE'");

        if ($check->num_rows > 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Ya existe una unidad con este TE"
            ]);
        exit();
        }

       $urlImagen = $_POST["imagen_url"];

        $conn->query("INSERT INTO marca(nombre_marca) VALUES ('$Marca')");
        $conn->query("INSERT INTO modelo(nombre_modelo) VALUES ('$Modelo')");
        $conn->query("INSERT INTO dueño(Nombre_dueño) VALUES ('$Dueño')");

        $sql = "INSERT INTO unidades(TE, año, matricula, imagen)
                VALUES ('$TE', '$Año','$Matricula', '$urlImagen')";

        if ($conn->query($sql)) {
            echo json_encode(["status"=>"success","message"=>"Unidad registrada con éxito"]);
        } else {
            echo json_encode(["status"=>"error","message"=>$conn->error]);
        }

        exit();
    }
}
?>