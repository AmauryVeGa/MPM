<?php
$conn = new mysqli("localhost", "root", "", "mpm");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo = $_POST["tipo"];

    /* =============================
       REGISTRAR USUARIO
    ============================= */
    if ($tipo == "registro_usuario") {

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        if (empty($usuario) || empty($password) || empty($email)) {
            echo json_encode(["status"=>"error","message"=>"Todos los campos son obligatorios"]);
            exit();
        }

        // Verificar usuario
        $stmt = $conn->prepare("SELECT cv_usuario FROM usuario WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo json_encode(["status"=>"error","message"=>"El usuario ya existe"]);
            exit();
        }

        // Verificar email
        $stmt = $conn->prepare("SELECT cv_usuario FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo json_encode(["status"=>"error","message"=>"El email ya está en uso"]);
            exit();
        }

        // INSERT
        $stmt = $conn->prepare("INSERT INTO usuario (usuario, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usuario, $password, $email);

        if ($stmt->execute()) {
            echo json_encode(["status"=>"success","message"=>"Usuario registrado con éxito"]);
        } else {
            echo json_encode(["status"=>"error","message"=>"Error al registrar"]);
        }

        exit();
    }

    /* =============================
       ACTUALIZAR USUARIO
    ============================= */
    if ($tipo == "actualizar_usuario") {

        $usuario = $_POST["usuario"];
        $nuevo = $_POST["nuevo_usuario"];
        $password = $_POST["password"];

        if (empty($usuario) || empty($nuevo) || empty($password)) {
            echo json_encode(["status"=>"error","message"=>"Todos los campos son obligatorios"]);
            exit();
        }

        $stmt = $conn->prepare("SELECT cv_usuario FROM usuario WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0) {
            echo json_encode(["status"=>"error","message"=>"El usuario no existe"]);
            exit();
        }

        $stmt = $conn->prepare("UPDATE usuario SET usuario=?, password=? WHERE usuario=?");
        $stmt->bind_param("sss", $nuevo, $password, $usuario);

        $stmt->execute();

        echo json_encode(["status"=>"success","message"=>"Usuario actualizado"]);
        exit();
    }

    /* =============================
       BORRAR USUARIO
    ============================= */
    if ($tipo == "borrar_usuario") {

        $id = $_POST["id"];

        $stmt = $conn->prepare("DELETE FROM usuario WHERE cv_usuario=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(["status"=>"success","message"=>"Usuario eliminado"]);
        } else {
            echo json_encode(["status"=>"error","message"=>"Error al eliminar"]);
        }

        exit();
    }
}
?>