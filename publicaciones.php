<?php

  session_start();

  include("php/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administra tus publicaciones | GeoSnap</title>
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
                      $id = $fila["id"];
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
                            <a href="#" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext me-3" viewBox="0 0 16 16">
                                    <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                                </svg>
                                Publicaciones
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="feedback.php" class="nav-link link-dark">
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
              <a href="#" class="nav-link py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                  <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="feedback.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
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
          <div class="d-flex flex-column m-4 p-4 bg-white rounded-4" style="overflow-y: auto;">
            <h3 class="fw-bold">Administra tus publicaciones</h3>

            <hr>

            <div class="row mx-2">
                <div class="col">
                    <span>Contenido</span>
                </div>
                <div class="col d-flex justify-content-center">
                  <span class="me-4">Acciones</span>
                  <span class="ms-3">Fecha</span>
                </div>
                <div class="col d-flex justify-content-end">
                    <span>Edición</span>
                </div>
            </div>

            <hr>

            <?php
              $stmt = $conexion->prepare("SELECT * FROM publicaciones WHERE id_usuario=?");
              $stmt->bind_param("i", $id);
              $stmt->execute();

              $result = $stmt->get_result();

              if(mysqli_num_rows($result) > 0) {
                while($fila = mysqli_fetch_assoc($result)) {
                  $archivo = $fila["archivo"];
                  $descripcion = $fila["descripcion"];
                  $fecha = $fila["fecha"];
                  $id_publicacion = $fila["id"];
                  $likes = $fila["likes"];
                  $num_comentarios = $fila["num_comentarios"];
            ?>

            <div class="row align-items-center mb-4">
                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="img/<?php echo $archivo; ?>" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;"" alt="Publicación: <?php echo $descripcion; ?>">
                          </div>
                          <div class="col-md-8">
                            <div class="p-2 d-flex flex-column justify-content-between" style="height: 100%;">
                              <p class="card-text text-nowrap overflow-hidden" style="max-width: 350px;"><?php echo $descripcion; ?></p>
                              <p class="card-text d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart me-1" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                                <?php echo $likes; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat ms-4 me-1" viewBox="0 0 16 16">
                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                </svg>
                                <?php echo $num_comentarios; ?>
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col d-flex justify-content-center gap-3">
                  <form action="php/borrar_publicacion.php" method="post">
                    <input type="hidden" name="id_publicacion" value="<?php echo $id_publicacion; ?>" />
                    <button type="submit" class="btn me-3" name="borrar">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                      </svg>
                    </button>
                  </form>
                  <span class="py-2"><?php echo $fecha; ?></span>
                </div>

                <div class="col d-flex justify-content-end">
                  <button type="button" class="btn btn-outline-secondary" style="max-width: 200px;" data-bs-toggle="modal" data-bs-target="#editar-publicacion" data-bs-whatever="@mdo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    Editar publicación
                  </button>
                </div>
            </div>
            <?php
                }
              }
            ?>
          </div>
        </div>

        <!-- Modal editar publicación -->
        <div class="modal fade" id="editar-publicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="php/editar-publicacion.php" method="post">
                  <div class="mb-3">
                    <label for="nombre-usuario" class="col-form-label">Descripción de la publicación:</label>
                    <textarea class="form-control" id="descrip" name="descrip"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="nombre" class="col-form-label">Ubicación:</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                  </div>
                  <div class="mb-3">
                    <label for="apellidos" class="col-form-label">Tipo de lugar:</label>
                    <input type="text" class="form-control" id="etiqueta" name="etiqueta">
                  </div>
                  <div class="mb-3">
                    <label for="biografia" class="col-form-label">País:</label>
                    <input type="text" class="form-control" id="pais" name="pais">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Guardar" name="guardar">
              </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>