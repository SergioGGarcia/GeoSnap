<?php

  session_start();

  include("php/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danos feedback sobre la app | GeoSnap</title>
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/publicar.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/jpg" href="img/favicon.png"/>
    </head>

    <body>

      <nav class="navbar border-bottom fixed-top bg-white">
            <div class="container-fluid">
              <a class="navbar-brand text-primary logo" href="principal.php">GeoSnap</a>
            <div class="btn-group">
                <button type="button" class="dropdown-toggle bg-white border-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <?php

                    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                    $stmt->bind_param("s", $_COOKIE["usuario"]);
                    $stmt->execute();

                    $result = $stmt->get_result();

                    while($fila = mysqli_fetch_assoc($result)) {
                      $foto_perfil = $fila["foto_perfil"];
                      $tipo_usuario = $fila["tipo_usuario"];
                    }

                    if (is_null($foto_perfil)) {

                    ?>

                    <img src="img/person-circle.svg" style="width: 35px;">

                    <?php

                    } else {

                    ?>

                    <img src="img/<?php echo $foto_perfil ?>" class="rounded-circle" style="width: 35px; height: 35px;">

                    <?php

                    }

                  ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php

                    if($tipo_usuario == "admin") {

                  ?>

                  <li><button onclick="location.href='dashboard/index.php'" class="dropdown-item" type="button">Panel de control</button></li>

                  <?php

                    }

                  ?>
                  <li><button onclick="location.href='perfil.php'" class="dropdown-item" type="button">Perfil</button></li>
                  <li><button onclick="location.href='php/cerrar_sesion.php'" class="dropdown-item" type="button">Cerrar sesión</button></li>
                </ul>
            </div>
      </nav>

      <div class="contenedor">
        <div>
          <nav class="sidebar-largo">
            <div class="contenido-sidebar">
                <div>
                    <a href="publicar.php" class="btn bg-primary text-white d-flex align-items-center justify-content-center btn-publicar">Subir</a>
                    <hr>
                    <ul class="nav nav-pills flex-column">
                        <div>
                            <li class="nav-item">
                            <a href="publicaciones.php" class="nav-link link-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext me-3" viewBox="0 0 16 16">
                                    <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                                </svg>
                                Publicaciones
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="#" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-dots me-3" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                    <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                                Feedback
                            </a>
                            </li>
                        </div>
                    </ul>
                </div>
                <div>
                    <a href="principal.php" class="nav-link link-dark p-0 fw-bold">Volver a GeoSnap</a>
                    <hr>
                    <div class="footer-sidebar d-flex flex-column">
                      <a href="footer/terminos.html" target="_blank">Términos</a>
                      <a href="footer/politicas.html" target="_blank">Políticas de privacidad</a>
                        <span class="copiright mt-2">© 2024 GeoSnap</span>
                    </div>
                </div>
            </div>
          </nav>
        </div>

        <div class="flex-column flex-shrink-0 border-end sidebar-corto" style="width: 4.5rem;">
          <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item">
              <a href="publicar.php" class="nav-link link-dark py-3" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="publicaciones.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                  <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                  <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="principal.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                </svg>
              </a>
            </li>
          </ul>
        </div>


        <div class="main-body justify-content-start">
          <div class="d-flex flex-column m-4 p-4 bg-white rounded-4" style="width: 80%;">
            <h3 class="fw-bold mb-5">Comparte tu opinión</h3>

            <form action="php/enviar-feedback.php" method="post">
                <div class="mb-4">
                    <label for="titulo" class="form-label fw-bold">Titulo de tu comentario *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                <div class="d-flex flex-column mb-4">
                    <label for="correo" class="form-label fw-bold">Tu correo electrónico</label>
                    <span class="text-secondary">Déjanos tu correo electrónico en caso de que necesitemos enviarte una respuesta</span>
                    <input type="email" class="form-control" id="correo" name="email" pattern=".+@example\.com">
                </div>
                <div class="d-flex flex-column mb-4">
                    <label for="comentario" class="form-label fw-bold">Especifica más detalles *</label>
                    <span class="text-secondary">Proporciona tantos detalles como puedas</span>
                    <textarea class="form-control" id="comentario" rows="3" name="feedback"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
            </form>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>