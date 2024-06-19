<?php

/*BackEnd de la página login*/

    try {

        session_start();

        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "geosnap");

        // Control de error de conexión
        if ($conexion->connect_errno) {
            throw new exception("No se ha podido conectar a la base de datos");
        }


        // Parte del código para iniciar sesión
        if (isset($_POST["iniciar_sesion"])) {

            $usuario = $_POST["usuarioI"];
            $contraseña = $_POST["contraseñaI"];
            $contraseña = hash("sha512", $contraseña);

            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=? AND contraseña=?");
            $stmt->bind_param("ss", $usuario, $contraseña);
            $stmt->execute();

            $result = $stmt->get_result();

            // Si el usuario está registrado le mandamos a la página principal
            if (mysqli_num_rows($result) > 0) {

                $_SESSION["usuario"] = $usuario;
                setcookie("usuario", $usuario, time()+3600*24, "/");
                header("Location: ../principal.php");

                // Cerramos la conexión
                $conexion->close();

                // El script se queda ahi y no se ejecuta lo de abajo
                exit();
            } else {
                echo "<script>
                    alert('El usuario no existe, por favor verifique los datos e intentelo de nuevo');
                    window.location = '../index.php';
                </script>";

                // Cerramos la conexión
                $conexion->close();

                exit();
            }



        // Parte del código para registrarse
        } else if (isset($_POST["registrarse"])) {

            // Variables del formulario de registro
            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $usuario = $_POST["usuarioR"];
            $correo = $_POST["correo"];
            $tipo_usuario = "usuario";
            $contraseña = $_POST["contraseñaR"];
            // Encriptar contraseña
            $contraseña = hash("sha512", $contraseña);

            // Query para verificar que no existe el correo introducido
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email=?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();

            $verificar_correo = $stmt->get_result();

            // Si existe mostramos un mensaje de que ese correo ya está registrado
            if (mysqli_num_rows($verificar_correo) > 0) {
                echo "<script>
                    alert('Ese correo ya esta registrado, prueba con otro');
                    window.location = '../index.php';
                </script>";

                // Cerramos la conexión
                $conexion->close();

                // Si esta registrado el script se queda ahi y no se ejecuta lo de abajo
                exit();
            }

            // Query para verificar que no existe el usuario introducido
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();

            $verificar_usuario = $stmt->get_result();

            // Si existe mostramos un mensaje de que ese correo ya está registrado
            if (mysqli_num_rows($verificar_usuario) > 0) {
                echo "<script>
                    alert('Ese nombre de usuario ya esta registrado, prueba con otro');
                    window.location = '../index.php';
                </script>";

                // Cerramos la conexión
                $conexion->close();

                // Si esta registrado, el script se queda ahi y no se ejecuta lo de abajo
                exit();
            }


            // Ejecutamos la query para insertar los datos del usuario registrado
            $stmt = $conexion->prepare("INSERT INTO usuarios(nombre, apellidos, nombre_usuario, email, contraseña, tipo_usuario) values (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nombre, $apellidos, $usuario, $correo, $contraseña, $tipo_usuario);
            $stmt->execute();

            $result = $stmt->get_result();

            // Si todo va bien, el usuario se registrará correctamente
            if (!$result) {

                echo "<script>
                    alert('Usuario registrado correctamente, por favor inicia sesión');
                    window.location = '../index.php';
                </script>";

            // Si algo falla le pediremos al usuario que lo intente de nuevo
            } else {

                echo "<script>
                    alert('Intentelo de nuevo, usuario no registrado');
                    window.location = '../index.php';
                </script>";
            }
        }

        // Cerramos la conexión
        $conexion->close();

    } catch (Exception $e) {
        echo $e->getMessage();
    }