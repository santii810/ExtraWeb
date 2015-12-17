<?php
// Si el usuario no está autenticado entonces lo mandamos a la página de autenticación(login.php)
if ( !autentificado() ){
header('Location: login.php'); // Cuidado con esta función. Debe ser llamada antes de MOSTRAR NADA por pantalla, incluidos espacios en blanco.
}
 
// Si no, significa que está autenticado y podemos cargar el contenido de la página.
?>