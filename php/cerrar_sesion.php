<?php

    // Fichero php solamente para cerrar sesion y que el usuario tenga que volver a iniciar sesión
    session_start();

    session_destroy();

    setcookie("usuario", "", time()-3600, "/");
    
    header("Location: ../index.php");