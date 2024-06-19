<?php

  session_start();

  include("php/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_COOKIE["usuario"]; ?> - GeoSnap</title>
        <link rel="stylesheet" href="css/estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/jpg" href="img/favicon.png"/>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </head>

    <body>

    <nav class="navbar border-bottom fixed-top bg-white">
            <div class="container-fluid">
              <a class="navbar-brand text-primary logo" href="principal.php">GeoSnap</a>
              <div class="d-flex flex-column container-buscador">
                <form class="buscador" role="search" id="ctn-buscador" action="buscar.php" method="post">
                  <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" id="buscador" name="buscador">
                  <button class="btn btn-outline-primary" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                  </button>
                </form>

                <?php
                  $stmt = $conexion->prepare("SELECT * FROM usuarios");
                  $stmt->execute();

                  $result = $stmt->get_result();
                ?>

                <form action="perfil-otro.php" method="post">
                  <ul class="p-0" id="buscador_lista">
                    <?php
                      while($fila = mysqli_fetch_assoc($result)) {
                    ?>
                    <li><button type="submit" value="<?php echo $fila["nombre_usuario"]; ?>" name="usuario">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                      <?php echo $fila["nombre_usuario"]; ?>
                    </button></li>
                      <?php
                        }
                      ?>
                  </ul>
                </form>
              </div>

              <div class="btn-group">
                <button type="button" class="dropdown-toggle bg-white border-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">

                  <?php

                    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                    $stmt->bind_param("s", $_COOKIE["usuario"]);
                    $stmt->execute();

                    $result = $stmt->get_result();

                    while($fila = mysqli_fetch_assoc($result)) {
                      $foto_perfil = $fila["foto_perfil"];
                      $nombre = $fila["nombre"];
                      $apellidos = $fila["apellidos"];
                      $biografia = $fila["biografia"];
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
            </div>
      </nav>

      <div id="cover_ctn_buscador"></div>

      <div class="contenedor">
        <div>
          <nav class="sidebar-largo">
            <div class="scrollbox">
                <div class="scrollbox-inner">
                    <div>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                              <a href="principal.php" class="nav-link link-dark">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door me-3" viewBox="0 0 16 16">
                                      <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                                  </svg>
                                Inicio
                              </a>
                            </li>
                            <li>
                              <a href="siguiendo.php" class="nav-link link-dark" aria-current="page">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-check me-3" viewBox="0 0 16 16">
                                      <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                      <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                                  </svg>
                                Siguiendo
                              </a>
                            </li>
                            <li>
                              <a href="explorar.php" class="nav-link link-dark">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search me-3" viewBox="0 0 16 16">
                                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                  </svg>
                                Explorar
                              </a>
                            </li>
                            <li>
                              <a href="publicar.php" class="nav-link link-dark">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext me-3" viewBox="0 0 16 16">
                                      <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                                      <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                                  </svg>
                                Publicar
                              </a>
                            </li>
                            <li>
                              <a href="#" class="nav-link">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person me-3" viewBox="0 0 16 16">
                                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                  </svg>
                                Perfil
                              </a>
                            </li>
                          </ul>
                          <hr>
                          <div class="mid-sidebar d-flex flex-column my-5">

                            <?php
                                $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                                $stmt->bind_param("s", $_COOKIE["usuario"]);
                                $stmt->execute();
  
                                $result = $stmt->get_result();

                                while($fila = mysqli_fetch_assoc($result)) {
                                  $id = $fila["id"];
                                }

                                $stmt = $conexion->prepare("SELECT * FROM seguidos WHERE id=?");
                                $stmt->bind_param("i", $id);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                if (mysqli_num_rows($result) > 0) {
                                  while($fila = mysqli_fetch_assoc($result)) {
                                    $nombre_usuario_seguido = $fila["nombre_usuario_seguido"];

                                    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                                    $stmt->bind_param("s", $nombre_usuario_seguido);
                                    $stmt->execute();

                                    $result_secundario = $stmt->get_result();

                                    while($fila_secundaria = mysqli_fetch_assoc($result_secundario)) {
                                      $nombre_secundario = $fila_secundaria["nombre"];
                                      $apellidos_secundario = $fila_secundaria["apellidos"];
                                      $foto_perfil_secundaria = $fila_secundaria["foto_perfil"];
                                    }
                            ?>

                            <a href="perfil-otro.php?usuario=<?php echo urlencode($nombre_usuario_seguido) ?>" class="text-decoration-none">
                              <div class="card border-0 mb-1 p-2 usuario_seguido">
                                <div class="g-0 d-flex">
                                  <div class="d-flex" style="width: 40px;">

                                    <?php
                                      if (is_null($foto_perfil_secundaria)) {
                                    ?>

                                    <img src="img/person-circle.svg" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 33px;">

                                    <?php
                                      } else {
                                    ?>

                                    <img src="img/<?php echo $foto_perfil_secundaria; ?>" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 40px; height: 40px;">

                                    <?php
                                      }
                                    ?>
                                  </div>
                                  <div>
                                    <div class="ms-2">
                                      <p class="m-0 bold-600"><?php echo $nombre_usuario_seguido; ?></p>
                                      <p class="card-text text-body-secondary size-pequeño"><?php echo $nombre_secundario . " " . $apellidos_secundario; ?></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>

                            <?php
                              }
                            } else {
                            ?>

                            <p class="fw-bold text-center">No sigues a nadie</p>
                            <p class="text-secondary text-center">Ve a <a href="explorar.html" class="text-dark fw-bold ve-a-explorar">Explorar</a> y empieza a conocer gente y lugares nuevos</p>

                            <?php

                              }

                            ?>

                          </div>
                          <hr>
                          <div class="footer-sidebar">
                              <span class="fw-bold">Compañía</span>
                              <div class="d-flex flex-column mb-4 ms-2">
                                  <a href="footer/acerca.html" target="_blank">Acerca de</a>
                                  <a href="footer/contactos.html" target="_blank">Contactos</a>
                              </div>
                              <span class="fw-bold">Términos y políticas</span>
                              <div class="d-flex flex-column mb-4 ms-2">
                                <a href="footer/ayuda.html" target="_blank">Ayuda</a>
                                <a href="footer/terminos.html" target="_blank">Términos</a>
                                <a href="footer/politicas.html" target="_blank">Política de privacidad</a>
                                <a href="footer/normas.html" target="_blank">Normas de la comunidad</a>
                              </div>
                              <span class="copiright">© 2024 GeoSnap</span>
                          </div>
                    </div>
                </div>
            </div>
          </nav>
        </div>

        <div class="flex-column flex-shrink-0 border-end sidebar-corto" style="width: 4.5rem;">
          <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item">
              <a href="principal.php" class="nav-link link-dark py-3" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
              </svg>
              </a>
            </li>
            <li>
              <a href="siguiendo.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="explorar.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="publicar.php" class="nav-link link-dark py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                  <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link py-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
              </svg>
              </a>
            </li>
          </ul>
        </div>

        <div class="contenido-perfil p-4">
            <div class="d-flex flex-column">
                <div class="d-flex flex-column">
                    <div class="d-flex align-items-start mb-4">

                        <?php
                          if (is_null($foto_perfil)) {
                        ?>

                        <img src="img/person-circle.svg" style="width: 100px;">

                        <?php
                          } else {
                        ?>

                        <img src="img/<?php echo $foto_perfil ?>" class="rounded-circle" style="width: 100px; height: 100px;">

                        <?php
                          }
                        ?>
                        <div class="d-flex flex-column ms-4">
                            <h4 class="fw-bold"><?php echo $_COOKIE["usuario"] ?></h4>
                            <span class="fw-medium mb-4"><?php echo $nombre . " " . $apellidos ?></span>
                            <button type="button" class="btn btn-outline-secondary" style="max-width: 200px;" data-bs-toggle="modal" data-bs-target="#editar-perfil" data-bs-whatever="@mdo">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                              Editar perfil
                            </button>
                        </div>
                    </div>

                    <?php

                      $stmt = $conexion->prepare("SELECT * FROM seguidos WHERE nombre_usuario=?");
                      $stmt->bind_param("s", $_COOKIE["usuario"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $num_seguidos = mysqli_num_rows($result);

                      $stmt = $conexion->prepare("SELECT * FROM seguidores WHERE nombre_usuario=?");
                      $stmt->bind_param("s", $_COOKIE["usuario"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $num_seguidores = mysqli_num_rows($result);

                      $stmt = $conexion->prepare("SELECT * FROM publicaciones WHERE id_usuario=?");
                      $stmt->bind_param("i", $id);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $num_publicaciones = mysqli_num_rows($result);

                    ?>

                    <div class="d-flex mb-3">
                        <span class="fw-semibold me-2"><?php echo $num_seguidos; ?></span>
                        <button type="button" class="me-4 border-0 bg-white btn-siguiendo" data-bs-toggle="modal" data-bs-target="#siguiendo">
                          Siguiendo
                        </button>
                        <span class="fw-semibold me-2"><?php echo $num_seguidores; ?></span>
                        <button type="button" class="me-4 border-0 bg-white btn-siguiendo" data-bs-toggle="modal" data-bs-target="#seguidores">
                          Seguidores
                        </button>
                        <span class="fw-semibold me-2"><?php echo $num_publicaciones; ?></span><span>Publicaciones</span>
                    </div>
                    <div style="max-width: 350px">
                        <span><?php echo $biografia ?></span>
                    </div>
                </div>

                <hr style="color: #acacac;">

                <div class="contenido-explorar my-4">
                  <?php

                    $stmt = $conexion->prepare("SELECT * FROM publicaciones WHERE id_usuario=?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();

                    $result = $stmt->get_result();

                    if(mysqli_num_rows($result) > 0) {
                      while($fila = mysqli_fetch_assoc($result)) {
                        $id_publicacion = $fila["id"];
                        $archivo = $fila["archivo"];
                        $ubicacion = $fila["ubicacion"];
                        $descripcion = $fila["descripcion"];
                        $fecha = $fila["fecha"];

                        $likes = $fila["likes"];
                        $num_comentarios = $fila["num_comentarios"];
                  ?>
                    <div class="card" style="width: 100%; height: 400px; border: none;">
                      <button type="button" class="border-0" id="btn-publicacion" style="width: 100%; height: 400px;" data-bs-toggle="modal" data-bs-target="#publicacion-<?php echo $id_publicacion; ?>" data-ubicacion="<?php echo $ubicacion; ?>" data-id="<?php echo $id_publicacion; ?>" data-publicacion="<?php echo $archivo; ?>" data-likes="<?php echo $likes; ?>" data-comentarios="<?php echo $num_comentarios; ?>" data-nombre="<?php echo $_COOKIE["usuario"]; ?>" data-descripcion="<?php echo $descripcion; ?>" data-fecha="<?php echo $fecha; ?>"><img src="img/<?php echo $archivo; ?>" class="card-img-top rounded-bottom" style="width: 100%; height: 100%; object-fit: cover;" alt="Publicación: <?php echo $descripcion; ?>"></button>
                      <div class="card-body d-flex flex-column p-2">
                        <p class="card-text text-nowrap overflow-hidden"><?php echo $descripcion; ?></p>
                      </div>
                    </div>

                    <!-- Modal publicacion -->
                    <div class="modal fade" id="publicacion-<?php echo $id_publicacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 1000px;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Publicación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <a href="https://www.google.es/maps/@40.4160512,-3.6831232,13z?hl=es&entry=ttu" target="_blank" id="modal-ubicacion-<?php echo $id_publicacion; ?>" class="text-decoration-none ms-2 text-secondary"></a>

                            <img id="modal-img-publicacion-<?php echo $id_publicacion; ?>" class="card-img-top rounded-2 mt-2">

                            <div class="d-flex align-items-center mt-1">

                              <?php
                                $stmt = $conexion->prepare("SELECT * FROM likes WHERE id_publicacion=? AND id_usuario=?");
                                $stmt->bind_param("ii", $id_publicacion, $id);
                                $stmt->execute();

                                $result_likes = $stmt->get_result();

                                if(mysqli_num_rows($result_likes) == 0) {
                              ?>

                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart me-1 like" id="<?php echo $id_publicacion; ?>" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                              </svg>
                              <span class="me-3" id="likes_<?php echo $id_publicacion; ?>"><?php echo $likes; ?></span>

                              <?php
                                } else {
                              ?>

                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-heart me-1 like" id="<?php echo $id_publicacion; ?>" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                              </svg>
                              <span class="me-3" id="likes_<?php echo $id_publicacion; ?>"><?php echo $likes; ?></span>

                              <?php
                                }
                              ?>
                              <button type="button" class="btn p-0 d-flex" id="comentario" data-bs-toggle="modal" data-bs-target="#comentarios-<?php echo $id_publicacion; ?>" data-bs-whatever="@mdo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat me-1" viewBox="0 0 16 16">
                                  <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                </svg>
                              </button>
                              <span id="num-comentarios-<?php echo $id_publicacion; ?>"></span>
                            </div>

                            <div class="mt-3 mb-4">
                              <a class="fw-bold text-dark text-decoration-none me-2" id="modal-nombre-usuario-<?php echo $id_publicacion; ?>"></a>
                              <span id="modal-descrip-publicacion-<?php echo $id_publicacion; ?>"></span>
                            </div>

                            <span id="modal-fecha-publicacion-<?php echo $id_publicacion; ?>" class="text-secondary"></span>

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal comentarios -->
                    <div class="modal fade" id="comentarios-<?php echo $id_publicacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body overflow-scroll">

                            <?php
                              $stmt = $conexion->prepare("SELECT * FROM comentarios WHERE id_publicacion=?");
                              $stmt->bind_param("i", $id_publicacion);
                              $stmt->execute();

                              $result_comentarios = $stmt->get_result();

                              while($fila_comentarios = mysqli_fetch_assoc($result_comentarios)) {
                                $id_usuario_comentario = $fila_comentarios["id_usuario"];
                                $comentario = $fila_comentarios["contenido"];
                                $fecha = $fila_comentarios["fecha"];

                                $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id=?");
                                $stmt->bind_param("i", $id_usuario_comentario);
                                $stmt->execute();

                                $result_usuario_comentarios = $stmt->get_result();

                                while($fila_usuario_comentarios = mysqli_fetch_assoc($result_usuario_comentarios)) {
                                  $nombre_usuario_comentario = $fila_usuario_comentarios["nombre_usuario"];
                                }
                            ?>

                            <div class="d-flex flex-column mb-3">
                              <div>

                                <?php

                                  if($nombre_usuario_comentario == $_COOKIE["usuario"]) {

                                ?>

                                <a href="perfil.php" class="text-dark text-decoration-none fw-bold" id="usuario-comentario"><?php echo $nombre_usuario_comentario; ?>: </a>
                                
                                <?php

                                  } else {

                                ?>

                                <a href="perfil-otro.php?usuario=<?php echo $nombre_usuario_comentario; ?>" class="text-dark text-decoration-none fw-bold" id="usuario_comentario"><?php echo $nombre_usuario_comentario; ?>: </a>

                                <?php

                                  }

                                ?>

                                <span id="contenido_comentario"><?php echo $comentario; ?></span>
                              </div>
                              <span class="ms-auto text-secondary fw-light" id="fecha_comentario"><?php echo $fecha; ?></span>
                            </div>

                            <?php
                              }
                            ?>
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" id="id_usuario_<?php echo $id_publicacion; ?>" value="<?php echo $id_usuario_logeado; ?>">
                            <input type="hidden" id="id_publicacion_<?php echo $id_publicacion; ?>" value="<?php echo $id_publicacion; ?>">
                            <input type="text" class="form-control" id="nuevo_comentario_<?php echo $id_publicacion; ?>" placeholder="Escribe tu comentario...">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary enviar-comentario" data-id-publicacion="<?php echo $id_publicacion; ?>" data-num-comentarios="<?php echo $num_comentarios; ?>">Enviar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php
                      }
                    }
                  ?>
            </div>
        </div>

        <!-- Modal siguiendo -->
        <div class="modal fade" id="siguiendo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Personas que sigues</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <?php
                    $stmt = $conexion->prepare("SELECT * FROM seguidos WHERE nombre_usuario=?");
                    $stmt->bind_param("s", $_COOKIE["usuario"]);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($fila = mysqli_fetch_assoc($result)) {
                      $nombre_usuario_seguido = $fila["nombre_usuario_seguido"];
                ?>

                <a href="perfil-otro.php?usuario=<?php echo urlencode($nombre_usuario_seguido) ?>" class="text-decoration-none">
                  <div class="card border-0 mb-1 p-2 usuario_seguido">
                    <div class="g-0 d-flex">
                      <div class="d-flex" style="width: 40px;">

                        <?php
                          $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                          $stmt->bind_param("s", $nombre_usuario_seguido);
                          $stmt->execute();
                          $result_secundario = $stmt->get_result();

                          while ($fila_secundaria = mysqli_fetch_assoc($result_secundario)) {
                            $foto_perfil_secundaria = $fila_secundaria["foto_perfil"];
                            $nombre_secundario = $fila_secundaria["nombre"];
                            $apellidos_secundario = $fila_secundaria["apellidos"];
                          }

                          if (is_null($foto_perfil_secundaria)) {
                        ?>

                        <img src="img/person-circle.svg" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 33px;">

                        <?php
                          } else {
                        ?>

                        <img src="img/<?php echo $foto_perfil_secundaria; ?>" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 40px; height: 40px;">

                        <?php
                          }
                        ?>
                      </div>
                      <div>
                        <div class="ms-2">
                          <p class="m-0 bold-600"><?php echo $nombre_usuario_seguido; ?></p>
                          <p class="card-text text-body-secondary size-pequeño"><?php echo $nombre_secundario . " " . $apellidos_secundario; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>

                <?php
                  }
                ?>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal seguidores -->
        <div class="modal fade" id="seguidores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Personas que te siguen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <?php
                    $stmt = $conexion->prepare("SELECT * FROM seguidores WHERE nombre_usuario=?");
                    $stmt->bind_param("s", $_COOKIE["usuario"]);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($fila = mysqli_fetch_assoc($result)) {
                      $nombre_usuario_seguidor = $fila["nombre_usuario_seguidor"];
                ?>

                <a href="perfil-otro.php?usuario=<?php echo urlencode($nombre_usuario_seguidor) ?>" class="text-decoration-none">
                  <div class="card border-0 mb-1 p-2 usuario_seguido">
                    <div class="g-0 d-flex">
                      <div class="d-flex" style="width: 40px;">

                        <?php
                          $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
                          $stmt->bind_param("s", $nombre_usuario_seguidor);
                          $stmt->execute();
                          $result_secundario = $stmt->get_result();

                          while ($fila_secundaria = mysqli_fetch_assoc($result_secundario)) {
                            $foto_perfil_secundaria = $fila_secundaria["foto_perfil"];
                            $nombre_secundario = $fila_secundaria["nombre"];
                            $apellidos_secundario = $fila_secundaria["apellidos"];
                          }

                          if (is_null($foto_perfil_secundaria)) {
                        ?>

                        <img src="img/person-circle.svg" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 33px;">

                        <?php
                          } else {
                        ?>

                        <img src="img/<?php echo $foto_perfil_secundaria; ?>" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 40px; height: 40px;">

                        <?php
                          }
                        ?>
                      </div>
                      <div>
                        <div class="ms-2">
                          <p class="m-0 bold-600"><?php echo $nombre_usuario_seguidor; ?></p>
                          <p class="card-text text-body-secondary size-pequeño"><?php echo $nombre_secundario . " " . $apellidos_secundario; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>

                <?php
                  }
                ?>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal editar perfil -->
        <div class="modal fade" id="editar-perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="php/editar-perfil.php" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nombre-usuario" class="col-form-label">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                  </div>
                  <div class="mb-3">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                  </div>
                  <div class="mb-3">
                    <label for="apellidos" class="col-form-label">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                  </div>
                  <div class="mb-3">
                    <label for="biografia" class="col-form-label">Biografía del perfil:</label>
                    <textarea class="form-control" id="biografia" name="biografia"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="foto" class="col-form-label">Imagen del perfil:</label>
                    <input type="file" class="form-control" id="foto" name="foto"></input>
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

      <script src="js/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>