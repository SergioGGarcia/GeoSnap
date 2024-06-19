<?php

    session_start();
    include("conexion.php");

    if(isset($_POST["comentario"])) {

        $comentario = $_POST["comentario"];
        $id_publicacion = $_POST["id_publicacion"];
        $id_usuario = $_POST["id_usuario"];
        $fecha = date("Y-m-d");

        $stmt = $conexion->prepare("INSERT INTO comentarios (id_usuario, id_publicacion, contenido, fecha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $id_usuario, $id_publicacion, $comentario, $fecha);
        $stmt->execute();

        $stmt = $conexion->prepare("UPDATE publicaciones SET num_comentarios=num_comentarios+1 WHERE id=?");
        $stmt->bind_param("i", $id_publicacion);
        $stmt->execute();

        $response = [
            'success' => true,
            'comentario' => $comentario,
            'fecha' => $fecha,
            'id_usuario' => $id_usuario,
            'id_publicacion' => $id_publicacion,
            'nombre_usuario_comentario' => $_COOKIE['usuario']
        ];
        
        echo json_encode($response);
    } else {
        echo json_encode(["success" => false]);
    }