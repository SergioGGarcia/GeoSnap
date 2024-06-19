<?php

    session_start();

    include("conexion.php");

    if (isset($_POST["subir"])) {

        $ubicacion = $_POST["ubicacion"];
        $descripcion = $_POST["descripcion"];
        $etiqueta = $_POST["etiqueta"];
        $archivo = $_FILES["archivo"]["name"];
        $fecha = date("Y-m-d");

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
        $stmt->bind_param("s", $_COOKIE["usuario"]);
        $stmt->execute();

        $result = $stmt->get_result();

        while($fila = mysqli_fetch_assoc($result)) {
            $id_usuario = $fila["id"];
        }

        if(isset($archivo) && $archivo != "") {
            $tipo = $_FILES["archivo"]["type"];
            $temp = $_FILES["archivo"]["tmp_name"];

            if ( !((strpos($tipo,"gif") || strpos($tipo,"jpg") || strpos($tipo,"jpeg") || strpos($tipo,"webp")))) {

                echo "<script>
                    alert('La imágen que has subido no es compatible, solo se permiten archivos .gif, .jpg, .jpeg y .webp');
                    window.location = '../publicar.php';
                </script>";

            } else {

                $stmt = $conexion->prepare("INSERT INTO publicaciones(id_usuario, archivo, ubicacion, descripcion, etiqueta, fecha) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $id_usuario, $archivo, $ubicacion, $descripcion, $etiqueta, $fecha);
                $stmt->execute();

                $result = $stmt->get_result();

                if (!$result) {

                    move_uploaded_file($temp, "../img/$archivo");
                    header("location:../publicaciones.php");
                    exit();

                } else {
                    echo "<script>
                        alert('Ocurrió un error en el servidor');
                        window.location = '../publicar.php';
                    </script>";
                }
            }
        }
    }