<?php
    session_start();

    include("conexion.php");

    if (isset($_POST["borrar"])) {
        $id_publicacion = $_POST["id_publicacion"];

        $stmt = $conexion->prepare("DELETE FROM publicaciones WHERE id=?");
        $stmt->bind_param("i", $id_publicacion);
        $stmt->execute();

        $result = $stmt->get_result();

        if(!$result) {
            header("location:../publicaciones.php");
            exit();
        } else {
            echo "<script>
                    alert('Ocurrió un error en el servidor');
                    window.location = '../publicaciones.php';
                </script>";
        }
    }