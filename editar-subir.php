<?php

  session_start();

  include("php/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edita tu publicación | GeoSnap</title>
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/publicar.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
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


        <div class="main-body-subir">
          <div class="d-flex flex-column m-4 p-4 bg-white rounded-4" style="width: 80%;">
            <h3 class="fw-bold mb-5">Subir</h3>

            <form action="php/subir.php" method="post" enctype="multipart/form-data">
                <label for="archivo" class="form-label fw-bold">Imagen o video</label>
                <input type="file" name="archivo" class="form-control mb-5">
                <div class="mb-4">
                    <label for="ubicacion" class="form-label fw-bold">Ubicación del sitio</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion">
                </div>
                <div class="d-flex flex-column mb-4">
                    <label for="correo" class="form-label fw-bold">Descripción de la publicación</label>
                    <span class="text-secondary">Déja una descripción sobre el sitio que vas a subir</span>
                    <textarea class="form-control" id="comentario" rows="3" name="descripcion"></textarea>
                </div>
                <div class="d-flex flex-column mb-4">
                    <label for="comentario" class="form-label fw-bold">Tipo de lugar</label>
                    <span class="text-secondary mb-2">Indica que tipo de lugar es el adecuado para tu publicación</span>
                    <select name="etiqueta" style="max-width: 150px">
                        <option value="montaña">Montaña</option>
                        <option value="playa">Playa</option>
                        <option value="parque">Parque</option>
                        <option value="rio">Ríos</option>
                        <option value="lago">Lagos</option>
                        <option value="museo">Museo</option>
                        <option value="catedral">Catedrales</option>
                        <option value="palacio">Palacio</option>
                        <option value="restaurante">Restaurante</option>
                        <option value="bar">Bar</option>
                        <option value="discoteca">Discoteca</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="subir">Subir</button>
            </form>
          </div>
        </div>

        <div>
          <div id="map"></div>
        </div>

        <script src="js/script.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=APIKEY=places&callback=initMap" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>