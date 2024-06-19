<?php

    if(isset($_COOKIE["usuario"])) {
        header("Location: principal.php");
        exit();
    } else {

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GeoSnap</title>
        <link rel="stylesheet" href="css/login.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/jpg" href="img/favicon.png"/>
    </head>

    <body>

        <div class="py-5">
            <h3 class="text-white text-center fw-bold">Inicia sesión con tu cuenta o crea una para adentrarte en GeoSnap</h3>
        </div>

        <div class="container_todo">

            <div class="caja_trasera">
                <div class="caja_trasera_login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión con tu cuenta</p>
                    <button onclick="iniciarSesion()" id="btn_login">Iniciar Sesión</button>
                </div>

                <div class="caja_trasera_registro">
                    <h3>¿Aún no tienes cuenta?</h3>
                    <p>Registrate para poder iniciar sesión</p>
                    <button onclick="registro()" id="btn_registro">Registrarse</button>
                </div>
            </div>

            <div class="container_login_registro">
                <form action="php/login_registro.php" method="post" class="formulario_login">
                    <h2>Iniciar Sesión</h2>
                    <input type="texto" placeholder="Nombre de usuario" name="usuarioI">
                    <input type="password" placeholder="Contraseña" name="contraseñaI">
                    <button type="submit" name="iniciar_sesion">Entrar</button>
                </form>

                <form action="php/login_registro.php" method="post" class="formulario_registro">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre" name="nombre">
                    <input type="text" placeholder="Apellidos" name="apellidos">
                    <input type="texto" placeholder="Correo Electrónico" name="correo">
                    <input type="texto" placeholder="Usuario" name="usuarioR">
                    <input type="password" placeholder="Contraseña" name="contraseñaR">
                    <button type="submit" name="registrarse">Registrarse</button>
                </form>
            </div>

        </div>

        <script src="js/login.js"></script>

    </body>

</html>

<?php
    }
?>