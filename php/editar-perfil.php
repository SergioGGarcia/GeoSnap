<?php

    session_start();

    include("conexion.php");

    if (isset($_POST["guardar"])) {

        $nombre_usuario = $_POST["nombre_usuario"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $biografia = $_POST["biografia"];
        $imagen = $_FILES["foto"]["name"];

        if (isset($nombre_usuario) && $nombre_usuario != "") {

            $stmt = $conexion->prepare("UPDATE usuarios SET nombre_usuario=? WHERE nombre_usuario=?");
            $stmt->bind_param("ss", $nombre_usuario, $_SESSION["usuario"]);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {

                $_SESSION["usuario"] = $nombre_usuario;
                header("location:../perfil.php");

            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../perfil.php';
                </script>";
            }
        }

        if (isset($nombre) && $nombre != "") {

            $stmt = $conexion->prepare("UPDATE usuarios SET nombre=? WHERE nombre_usuario=?");
            $stmt->bind_param("ss", $nombre, $_SESSION["usuario"]);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {

                header("location:../perfil.php");

            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../perfil.php';
                </script>";
            }
        }

        if (isset($apellidos) && $apellidos != "") {

            $stmt = $conexion->prepare("UPDATE usuarios SET apellidos=? WHERE nombre_usuario=?");
            $stmt->bind_param("ss", $apellidos, $_SESSION["usuario"]);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {

                header("location:../perfil.php");

            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../perfil.php';
                </script>";
            }
        }

        if (isset($biografia) && $biografia != "") {

            $stmt = $conexion->prepare("UPDATE usuarios SET biografia=? WHERE nombre_usuario=?");
            $stmt->bind_param("ss", $biografia, $_SESSION["usuario"]);
            $stmt->execute();

            $result = $stmt->get_result();

            if (!$result) {

                header("location:../perfil.php");

            } else {
                echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../perfil.php';
                </script>";
            }
        }

        if(isset($imagen) && $imagen != "") {
            $tipo = $_FILES["foto"]["type"];
            $temp = $_FILES["foto"]["tmp_name"];

            if ( !((strpos($tipo,"gif") || strpos($tipo,"jpg") || strpos($tipo,"jpeg") || strpos($tipo,"webp")))) {

                echo "<script>
                    alert('La imágen que has subido no es compatible, solo se permiten archivos .gif, .jpg, .jpeg y .webp');
                    window.location = '../perfil.php';
                </script>";

            } else {

                $stmt = $conexion->prepare("UPDATE usuarios SET foto_perfil=? WHERE nombre_usuario=?");
                $stmt->bind_param("ss", $imagen, $_SESSION["usuario"]);
                $stmt->execute();

                $result = $stmt->get_result();

                if (!$result) {

                    move_uploaded_file($temp, "../img/$imagen");
                    header("location:../perfil.php");

                } else {
                    echo "<script>
                        alert('Ocurrió un error en el servidor');
                        window.location = '../perfil.php';
                    </script>";
                }
            }
        }

        if (empty($nombre_usuario) && empty($nombre) && empty($apellidos) && empty($biografia) && empty($imagen)) {
            header("location:../perfil.php");
            exit();
        }
    }