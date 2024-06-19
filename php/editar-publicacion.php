<?php

    session_start();

    include("conexion.php");

    if (isset($_POST["guardar"])) {

        $descrip = $_POST["descrip"];
        $ubicacion = $_POST["ubicacion"];
        $etiqueta = $_POST["etiqueta"];
        $pais = $_POST["pais"];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
        $stmt->bind_param("s", $_SESSION["usuario"]);
        $stmt->execute();

        $result = $stmt->get_result();
        while($fila = mysqli_fetch_assoc($result)) {
            $id_usuario = $fila["id"];
        }

        if (isset($descrip) && $descrip != "") {

            $stmt = $conexion->prepare("UPDATE publicaciones SET descripcion=? WHERE id_usuario=?");
            $stmt->bind_param("ss", $descrip, $id_usuario);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {
                header("location:../publicaciones.php");
            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../publicaciones.php';
                </script>";
            }
        }

        if (isset($ubicacion) && $ubicacion != "") {

            $stmt = $conexion->prepare("UPDATE publicaciones SET ubicacion=? WHERE id_usuario=?");
            $stmt->bind_param("ss", $ubicacion, $id_usuario);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {
                header("location:../publicaciones.php");
            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../publicaciones.php';
                </script>";
            }
        }

        if (isset($etiqueta) && $etiqueta != "") {

            $stmt = $conexion->prepare("UPDATE publicaciones SET etiqueta=? WHERE id_usuario=?");
            $stmt->bind_param("ss", $etiqueta, $id_usuario);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {
                header("location:../publicaciones.php");
            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../publicaciones.php';
                </script>";
            }
        }

        if (isset($pais) && $pais != "") {

            $stmt = $conexion->prepare("UPDATE publicaciones SET pais=? WHERE id_usuario=?");
            $stmt->bind_param("ss", $pais, $id_usuario);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {
                header("location:../publicaciones.php");
            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../publicaciones.php';
                </script>";
            }
        }

        if (empty($descrip) && empty($ubicacion) && empty($etiqueta) && empty($pais)) {
            header("location:../publicaciones.php");
            exit();
        }
    }