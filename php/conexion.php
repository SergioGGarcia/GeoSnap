<?php

try {

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "geosnap");

    // Control de error de conexión
    if ($conexion->connect_errno) {
        throw new exception("No se ha podido conectar a la base de datos");
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }