<?php

    session_start();

    include("conexion.php");

    $perfil_usuario = $_POST["usuario"];

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
    $stmt->bind_param("s", $_SESSION["usuario"]);
    $stmt->execute();

    $result = $stmt->get_result();

    while($fila = mysqli_fetch_assoc($result)) {
        $id = $fila["id"];
    }

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
    $stmt->bind_param("s", $perfil_usuario);
    $stmt->execute();

    $result = $stmt->get_result();

    while($fila = mysqli_fetch_assoc($result)) {
        $id_usuario_seguido = $fila["id"];
    }

    $stmt = $conexion->prepare("INSERT INTO seguidos(id, nombre_usuario, id_usuario_seguido, nombre_usuario_seguido) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $_SESSION["usuario"], $id_usuario_seguido, $perfil_usuario);
    $stmt->execute();

    $stmt = $conexion->prepare("INSERT INTO seguidores(id, nombre_usuario, id_usuario_seguidor, nombre_usuario_seguidor) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id_usuario_seguido, $perfil_usuario, $id, $_SESSION["usuario"]);
    $stmt->execute();

    header("Location: ../perfil-otro.php?usuario=".urlencode($perfil_usuario));
    exit();