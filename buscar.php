<?php

  session_start();

  include("php/conexion.php");

  $perfil_buscado = $_POST["buscador"];

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Encuentra a '<?php echo $perfil_buscado; ?>' en GeoSnap | GeoSnap</title>
        <link rel="stylesheet" href="css/estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/jpg" href="img/favicon.png"/>
    </head>

    <body>

      <nav class="navbar border-bottom fixed-top bg-white">
            <div class="container-fluid">
              <a class="navbar-brand text-primary logo" href="principal.html">GeoSnap</a>
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
                              <a href="principal.php" class="nav-link link-dark" aria-current="page">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door me-3" viewBox="0 0 16 16">
                                      <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                                  </svg>
                                Inicio
                              </a>
                            </li>
                            <li>
                              <a href="siguiendo.php" class="nav-link link-dark">
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

                              <a href="perfil.php" class="nav-link link-dark">
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
                                      $nombre = $fila_secundaria["nombre"];
                                      $apellidos = $fila_secundaria["apellidos"];
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
                                      <p class="card-text text-body-secondary size-pequeño"><?php echo $nombre . " " . $apellidos; ?></p>
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

              <a href="publicar.php" class="nav-link link-dark py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-richtext" viewBox="0 0 16 16">
                  <path d="M7 4.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m-.861 1.542 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208M5 9a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                </svg>
              </a>

            </li>
            <li>

              <a href="perfil.php" class="nav-link link-dark py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
              </a>
                              
            </li>
          </ul>
        </div>

        <div class="main-body">

          <form action="perfil-otro.php" method="post" style="width: 60%;">
            <?php
              $sql = "SELECT * FROM usuarios WHERE nombre_usuario LIKE '$perfil_buscado%'";
              $result = mysqli_query($conexion, $sql);

              $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario LIKE '$perfil_buscado%'");
              $stmt->execute();
  
              $result = $stmt->get_result();

              while($fila = mysqli_fetch_assoc($result)) {
            ?>

            <button class="card border-0 mt-5 p-3 btn-usuario" style="width: 100%;" name="usuario" value="<?php echo $fila["nombre_usuario"]; ?>">
              <div class="g-0 d-flex">
                <div class="d-flex" style="width: 60px;">
                  <?php
                    if(is_null($fila["foto_perfil"])){
                  ?>

                  <img src="img/person-circle.svg" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 60px; height: 60px;">

                  <?php
                    }else {
                  ?>

                  <img src="img/<?php echo $fila["foto_perfil"]; ?>" class="img-fluid rounded-circle" alt="foto de perfil" style="width: 60px; height: 60px;">

                  <?php
                    }
                  ?>
                </div>
                <div>
                  <div class="ms-4 text-start">
                    <p class="m-0 fw-bold fs-5"><?php echo $fila["nombre_usuario"]; ?></p>
                    <p class="mb-1 card-text text-body-secondary size-pequeño"><?php echo $fila["nombre"] . " " . $fila["apellidos"]; ?></p>
                    <p class="card-text fw-medium size-pequeño"><?php echo $fila["biografia"]; ?></p>
                  </div>
                </div>
              </div>
            </button>

            <?php
              }
            ?>
          </form>
        </div>
      </div>

      <script src="js/script.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>