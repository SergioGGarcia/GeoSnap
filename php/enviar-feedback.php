<?php

    session_start();

    if(isset($_POST["enviar"])) {

        $titulo = $_POST["titulo"];
        $email = $_POST["email"];
        $feedback = $_POST["feedback"];

        echo "<script>
                alert('Gracias por darnos feedback sobre nuestra aplicación, esperamos complacerle en todo lo posible');
                window.location = '../feedback.php';
            </script>";
    }