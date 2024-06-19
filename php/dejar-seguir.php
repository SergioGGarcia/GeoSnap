<?php

    session_start();

    include("conexion.php");

    $perfil_usuario = $_GET["usuario"];

    $stmt = $conexion->prepare("DELETE FROM seguidos WHERE nombre_usuario_seguido=? AND nombre_usuario=?");
    $stmt->bind_param("ss", $perfil_usuario, $_SESSION["usuario"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $stmt = $conexion->prepare("DELETE FROM seguidores WHERE nombre_usuario=? AND nombre_usuario_seguidor=?");
    $stmt->bind_param("ss", $perfil_usuario, $_SESSION["usuario"]);
    $stmt->execute();

    $result1 = $stmt->get_result();

    if(!$result && !$result1) {
        header("Location: ../perfil-otro.php?usuario=".urlencode($perfil_usuario));
        exit();
    } else {
        echo "<script>
                alert('Ocurrió un error en el servidor');
                window.location = '../perfil-otro.php?usuario=".urlencode($perfil_usuario)."';
            </script>";
    }