<?php

    session_start();
    include("conexion.php");

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
    $stmt->bind_param("s", $_COOKIE["usuario"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $fila = mysqli_fetch_assoc($result);
    $id_usuario = $fila["id"];

    $id_publicacion = mysqli_real_escape_string($conexion, $_POST["id"]);

    $stmt = $conexion->prepare("SELECT * FROM likes WHERE id_publicacion=? AND id_usuario=?");
    $stmt->bind_param("ii", $id_publicacion, $id_usuario);
    $stmt->execute();

    $result = $stmt->get_result();

    if (mysqli_num_rows($result) == 0) {

        $stmt = $conexion->prepare("INSERT INTO likes (id_usuario, id_publicacion) VALUES (?, ?)");
        $stmt->bind_param("ii", $id_usuario, $id_publicacion);
        $stmt->execute();

        $stmt = $conexion->prepare("UPDATE publicaciones SET likes=likes+1 WHERE id=?");
        $stmt->bind_param("i", $id_publicacion);
        $stmt->execute();

    } else {

        $stmt = $conexion->prepare("DELETE FROM likes WHERE id_publicacion=? AND id_usuario=?");
        $stmt->bind_param("ii", $id_publicacion, $id_usuario);
        $stmt->execute();

        $stmt = $conexion->prepare("UPDATE publicaciones SET likes=likes-1 WHERE id=?");
        $stmt->bind_param("i", $id_publicacion);
        $stmt->execute();

    }

    $sql = "SELECT * FROM publicaciones WHERE id=$id_publicacion";
    $result_likes = mysqli_query($conexion, $sql);

    $stmt = $conexion->prepare("SELECT * FROM publicaciones WHERE id=?");
    $stmt->bind_param("i", $id_publicacion);
    $stmt->execute();

    $result_likes = $stmt->get_result();

    $cont = mysqli_fetch_array($result_likes);
    $likes = $cont["likes"];

    if(mysqli_num_rows($result) >= 1) {

        $likes = $likes++;

    } else {

        $likes = $likes--;

    }

    echo $likes;