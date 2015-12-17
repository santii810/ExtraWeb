<?php
/* Abre la conexion con la base de datos */
function abrir_conexion(){  
    define("SERVIDOR", "localhost");
    define("USUARIO", "raspberry");
    define("PASS", "cFcE7jSSXsAY6AuY");
    define("BD", "ServidorWeb");
    $conexion = mysqli_connect(SERVIDOR, USUARIO, PASS, BD);
    if ($conexion){
        mysqli_set_charset($conexion, "UTF8");
    }
    return $conexion;
}
?>